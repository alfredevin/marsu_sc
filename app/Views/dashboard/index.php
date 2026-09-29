<!-- Print-Only Header -->
<div class="print-header">
    <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Logo" style="width: 60px; height: 60px;" class="mb-2">
    <h2>Marinduque State University</h2>
    <p class="font-weight-bold">College of Information and Computing Sciences</p>
    <p>Panfilo M. Manguera Sr. Rd., Brgy. Tanza, Boac, Marinduque 4900</p>
    <p class="small text-muted">Executive Dashboard Performance Report • Generated on <?= date('F j, Y, g:i A') ?></p>
</div>

<!-- Dashboard Top Header & Actions -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 no-print">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Executive Dashboard</h1>
        <p class="text-muted small mb-0">Centralized academic performance, institutional metrics, and module telemetry.</p>
    </div>

    <!-- Filters & Actions -->
    <div class="d-flex flex-wrap align-items-center gap-2">
        <select class="form-select form-select-sm" style="width: auto;" id="dashboardAyFilter">
            <?php foreach ($academicYears as $ay): ?>
                <option value="<?= e($ay['code']) ?>" <?= $ay['is_active'] ? 'selected' : '' ?>>
                    A.Y. <?= e($ay['code']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
            <i class="bi bi-printer"></i>
            <span>Print Report</span>
        </button>

        <a href="<?= url('dashboard') ?>" class="btn btn-marsu btn-sm d-flex align-items-center gap-1" title="Refresh Telemetry">
            <i class="bi bi-arrow-clockwise"></i>
            <span>Sync Data</span>
        </a>
    </div>
</div>

<!-- HERO KPI ROW (Burgundy Gradient with Gold Accents) -->
<div class="row g-3 mb-4">
    <!-- Total Enrolled Students -->
    <div class="col-xl-3 col-sm-6">
        <div class="card card-hero-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Active Students</div>
                    <div class="kpi-value" id="kpiStudents"><?= number_format($totalStudents) ?></div>
                    <div class="small opacity-75 mt-1"><i class="bi bi-check2-circle text-gold me-1"></i>Enrolled & Regular</div>
                </div>
                <div class="p-3 bg-white bg-opacity-10 rounded-3">
                    <i class="bi bi-mortarboard fs-3 text-gold"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Employees & Faculty -->
    <div class="col-xl-3 col-sm-6">
        <div class="card card-hero-kpi p-3 h-100" style="background: linear-gradient(135deg, #5C0016 0%, #3D000F 100%);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Faculty & Staff</div>
                    <div class="kpi-value" id="kpiEmployees"><?= number_format($totalEmployees) ?></div>
                    <div class="small opacity-75 mt-1"><i class="bi bi-briefcase text-gold me-1"></i>Academic & Admin</div>
                </div>
                <div class="p-3 bg-white bg-opacity-10 rounded-3">
                    <i class="bi bi-person-workspace fs-3 text-gold"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Colleges & Departments -->
    <div class="col-xl-3 col-sm-6">
        <div class="card card-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Colleges & Depts</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($totalDepartments) ?></div>
                    <div class="small text-muted mt-1"><a href="<?= url('departments') ?>" class="text-decoration-none text-marsu-burgundy">View directory &rarr;</a></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-diagram-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Academic Programs -->
    <div class="col-xl-3 col-sm-6">
        <div class="card card-kpi border-gold p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Academic Programs</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= number_format($totalPrograms) ?></div>
                    <div class="small text-muted mt-1"><a href="<?= url('programs') ?>" class="text-decoration-none text-marsu-burgundy">Curriculum map &rarr;</a></div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-book"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CHARTS ROW (Using MarSU Palette) -->
<div class="row g-4 mb-4">
    <!-- Program Enrollment Distribution -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-pie-chart-fill me-2"></i>Student Enrollment by Academic Program</h6>
                <span class="badge badge-gold">Current Term</span>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 280px;">
                    <canvas id="programEnrollmentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Distribution by Department -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-bar-chart-fill me-2"></i>Faculty & Staff by College</h6>
                <span class="badge badge-burgundy">Headcount</span>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 280px;">
                    <canvas id="employeeDeptChart"></canvas>
                </div>
            </div>
        </div>
</div>

<!-- CHARTS ROW 2: Year Level Population & Faculty Ranks -->
<div class="row g-4 mb-4">
    <!-- Student Population by Year Level -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-people-fill me-2"></i>Students by Year Level</h6>
                <span class="badge badge-burgundy">Cohort Breakdown</span>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 260px;">
                    <canvas id="yearLevelChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Faculty Rank Distribution -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-award me-2"></i>Faculty Academic Rank Distribution</h6>
                <span class="badge badge-gold">Academic Ranks</span>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 260px;">
                    <canvas id="facultyRankChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RECENT ACTIVITY AUDIT TRAIL & SYSTEM STATUS -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-activity me-2"></i>Recent Administrative Activity Feed</h6>
                <a href="<?= url('audit') ?>" class="btn btn-outline-marsu btn-sm">Full Audit Trail &rarr;</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light small text-uppercase text-muted">
                            <tr>
                                <th>Timestamp</th>
                                <th>User</th>
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

    <!-- Quick Core Reference Card -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header card-header-accent">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-info-circle-fill me-2"></i>Institutional Overview</h6>
            </div>
            <div class="card-body small">
                <div class="mb-3">
                    <div class="fw-bold text-marsu-burgundy">Marinduque State University</div>
                    <div class="text-muted">Main Campus • Boac, Marinduque</div>
                </div>
                <div class="mb-3">
                    <div class="fw-bold">College of Information and Computing Sciences</div>
                    <div class="text-muted">Leading innovation, digital transformation, and smart campus research.</div>
                </div>
                <div class="p-3 bg-light rounded border mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Platform Version:</span>
                        <strong class="text-marsu-burgundy">v1.0 Core</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Database:</span>
                        <span>MariaDB UTF-8mb4</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Server Environment:</span>
                        <span>Apache XAMPP</span>
                    </div>
                </div>
                <a href="<?= url('ui-kit') ?>" class="btn btn-outline-marsu btn-sm w-100">
                    <i class="bi bi-palette me-1"></i>View Core UI Kit Styleguide
                </a>
            </div>
        </div>
    </div>
</div>

<!-- AGGREGATED STUDENT MODULE WIDGETS SECTION (Multi-Module Contract) -->
<div class="mt-4 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="h5 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-boxes text-gold me-2"></i>Integrated Student Group Module Telemetry
            </h4>
            <p class="text-muted small mb-0">Real-time widgets fed into the core executive dashboard via the standard widget contract.</p>
        </div>
        <span class="badge badge-gold">11 Module Channels</span>
    </div>

    <?php if (empty($moduleWidgets)): ?>
        <div class="card p-4 text-center border-dashed">
            <div class="text-muted small">
                <i class="bi bi-puzzle fs-1 d-block mb-2 text-gold"></i>
                No external module widgets connected yet. As student groups deploy their <code>widgets.php</code>, their telemetry widgets will populate here automatically.
            </div>
        </div>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($moduleWidgets as $w): ?>
                <?php if (($w['type'] ?? '') === 'kpi'): ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-kpi p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge badge-gold mb-1" style="font-size:0.68rem;"><?= e($w['module_name'] ?? '') ?></span>
                                    <div class="small fw-bold text-muted"><?= e($w['title']) ?></div>
                                    <div class="h4 font-weight-bold text-marsu-burgundy mb-0 mt-1">
                                        <?= e($w['evaluated_data'] ?? '0') ?>
                                    </div>
                                </div>
                                <div class="kpi-icon-badge">
                                    <i class="bi <?= e($w['icon'] ?? 'bi-speedometer') ?>"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif (($w['type'] ?? '') === 'list'): ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-marsu-burgundy small"><?= e($w['title']) ?></h6>
                                <span class="badge badge-burgundy" style="font-size: 0.65rem;"><?= e($w['module_name']) ?></span>
                            </div>
                            <div class="card-body p-2 small">
                                <?php if (is_array($w['evaluated_data'])): ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($w['evaluated_data'] as $item): ?>
                                            <li class="list-group-item px-2 py-1 d-flex justify-content-between">
                                                <span><?= e($item['label'] ?? '') ?></span>
                                                <strong><?= e($item['value'] ?? '') ?></strong>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <div class="p-2 text-muted"><?= e((string)$w['evaluated_data']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Inline Chart.js Initialization using MarSU Palette -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Program Enrollment Chart
    const progCanvas = document.getElementById('programEnrollmentChart');
    if (progCanvas && window.Chart) {
        new Chart(progCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($enrollmentChart['labels']) ?>,
                datasets: [{
                    label: 'Students Enrolled',
                    data: <?= json_encode($enrollmentChart['values']) ?>,
                    backgroundColor: [
                        '#800020', // Burgundy
                        '#D4AF37', // Gold
                        '#C45A72', // Rose
                        '#B8922A', // Dark Gold
                        '#6E5A5E'  // Warm Gray
                    ],
                    borderRadius: 6
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
                        ticks: { stepSize: 10 }
                    }
                }
            }
        });
    }

    // 2. Department Employees Chart
    const deptCanvas = document.getElementById('employeeDeptChart');
    if (deptCanvas && window.Chart) {
        new Chart(deptCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($employeeChart['labels']) ?>,
                datasets: [{
                    data: <?= json_encode($employeeChart['values']) ?>,
                    backgroundColor: [
                        '#800020',
                        '#D4AF37',
                        '#C45A72',
                        '#B8922A',
                        '#5C0016',
                        '#6E5A5E'
                    ],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, padding: 12 }
                    }
                },
                cutout: '68%'
            }
        });
    }

    // 3. Student Year Level Distribution Chart
    const yrCanvas = document.getElementById('yearLevelChart');
    if (yrCanvas && window.Chart) {
        new Chart(yrCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($yearLevelChart['labels'] ?? []) ?>,
                datasets: [{
                    data: <?= json_encode($yearLevelChart['values'] ?? []) ?>,
                    backgroundColor: [
                        '#800020',
                        '#D4AF37',
                        '#C45A72',
                        '#5C0016'
                    ],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, padding: 12 }
                    }
                },
                cutout: '60%'
            }
        });
    }

    // 4. Faculty Rank Distribution Chart
    const rankCanvas = document.getElementById('facultyRankChart');
    if (rankCanvas && window.Chart) {
        new Chart(rankCanvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($facultyRankChart['labels'] ?? []) ?>,
                datasets: [{
                    label: 'Faculty Count',
                    data: <?= json_encode($facultyRankChart['values'] ?? []) ?>,
                    backgroundColor: '#D4AF37',
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { stepSize: 2 }
                    }
                }
            }
        });
    }
});
</script>
