<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <!-- Local Chart.js Vendor Asset -->
    <script src="<?= asset('assets/vendor/chart.js/chart.umd.min.js') ?>"></script>

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .kpi-border-bottleneck {
            border-left: 4px solid #dc3545 !important;
        }

        .kpi-border-success {
            border-left: 4px solid #198754 !important;
        }

        .kpi-border-primary {
            border-left: 4px solid #0d6efd !important;
        }

        .kpi-border-info {
            border-left: 4px solid #0dcaf0 !important;
        }
    </style>

    <!-- 1. HEADER AND FILTERS -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0">
                <i class="bi bi-bar-chart-steps me-1"></i> Course and Subject Performance
            </h6>
            <small class="text-muted">Subject-level grades, passing rates, and subjects where students need extra help.</small>
        </div>

        <form method="GET" action="" class="d-flex align-items-center gap-2 flex-wrap">
            <span class="small fw-semibold text-secondary">PROGRAM:</span>
            <select name="department" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <option value="">All Programs</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= htmlspecialchars($dept) ?>" <?= $department === $dept ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <span class="small fw-semibold text-secondary ms-1">SCHOOL YEAR:</span>
            <select name="school_year" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <?php foreach ($schoolYears as $sy): ?>
                    <option value="<?= htmlspecialchars($sy) ?>" <?= $schoolYear === $sy ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sy) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <span class="small fw-semibold text-secondary ms-1">SEMESTER:</span>
            <select name="semester" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <?php foreach ($semesters as $sem): ?>
                    <option value="<?= htmlspecialchars($sem) ?>" <?= $semester === $sem ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sem) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print
            </button>
        </form>
    </div>

    <!-- 2. SUMMARY KPI CARDS -->
    <div class="row g-3 mb-4">
        <!-- Passing Rate -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Cohort Passing Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= $overallPassingRate ?>%</h3>
                    <span class="badge bg-success-subtle text-success border border-success">Target: 85%</span>
                </div>
                <small class="text-muted mt-2 d-block">Overall rate of students passing their subjects</small>
            </div>
        </div>

        <!-- Average Grade -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Average Grade (GPA)</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= number_format($overallMeanGpa, 2) ?></h3>
                    <span class="badge bg-light text-secondary border">Passing: ≤ 3.00</span>
                </div>
                <small class="text-muted mt-2 d-block">Calculated across <?= $totalCourses ?> active subject offerings</small>
            </div>
        </div>

        <!-- Courses Needing Attention -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-bottleneck">
                <span class="text-muted small fw-semibold text-uppercase">Subjects Needing Help</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= $bottleneckCount ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Action Needed</span>
                </div>
                <small class="text-muted mt-2 d-block">Subjects with passing rates below 85% or high failures</small>
            </div>
        </div>

        <!-- Total Subjects -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Total Subjects</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $totalCourses ?></h3>
                    <span class="badge bg-light text-secondary border">Active</span>
                </div>
                <small class="text-muted mt-2 d-block">Total courses monitored in the database</small>
            </div>
        </div>
    </div>

    <!-- 3. VISUAL CHARTS -->
    <div class="row g-3 mb-4">
        <!-- Bar Chart: Passing Rate Comparison -->
        <div class="col-lg-8">
            <div class="card border rounded-3 shadow-sm bg-white h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-bar-chart-fill me-1 text-primary"></i> Subject Passing Rate vs Target (85%)
                    </h6>
                    <span class="badge bg-light text-secondary border">Active Term</span>
                </div>
                <div class="card-body p-3">
                    <?php if (!empty($coursePerformanceList)): ?>
                        <div style="height: 280px; position: relative;">
                            <canvas id="coursePassingBarChart"></canvas>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-bar-chart fs-1 d-block mb-2 text-secondary"></i>
                            <p class="mb-0 fw-semibold">No performance data found for chart</p>
                            <small>Charts will appear when subject grades are recorded.</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart: Grade Distribution -->
        <div class="col-lg-4">
            <div class="card border rounded-3 shadow-sm bg-white h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-pie-chart-fill me-1 text-primary"></i> Grade Breakdown
                    </h6>
                </div>
                <div class="card-body p-3 d-flex flex-column justify-content-center align-items-center">
                    <?php if (!empty($coursePerformanceList) && ($gradeDistribution['honor'] + $gradeDistribution['pass'] + $gradeDistribution['risk'] + $gradeDistribution['fail']) > 0): ?>
                        <div style="height: 200px; width: 100%; position: relative;">
                            <canvas id="gradeDistributionPieChart"></canvas>
                        </div>
                        <div class="mt-3 text-center small text-muted d-flex justify-content-around w-100 border-top pt-2">
                            <span><i class="bi bi-circle-fill text-success me-1"></i> Honor (≤ 1.75)</span>
                            <span><i class="bi bi-circle-fill text-primary me-1"></i> Pass (2.00 - 3.00)</span>
                            <span><i class="bi bi-circle-fill text-danger me-1"></i> Deficient (Fail / INC)</span>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-pie-chart fs-1 d-block mb-2 text-secondary"></i>
                            <p class="mb-0 fw-semibold">No grade breakdown available</p>
                            <small>Awaiting student grade records.</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. SUBJECT-BY-SUBJECT LIST -->
    <div class="card border rounded-3 shadow-sm bg-white mb-3">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-journal-text me-1"></i> Subject Performance List
            </h6>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="tableSearchInput" class="form-control form-control-sm"
                    placeholder="Search subject code or title..." style="width: 250px;" onkeyup="filterLedgerTable()">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="perfLedgerTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Subject Code</th>
                        <th class="py-3">Subject Title</th>
                        <th class="py-3">Program</th>
                        <th class="py-3 text-center">Units</th>
                        <th class="py-3 text-center">Enrolled</th>
                        <th class="py-3 text-center">Average Grade</th>
                        <th class="py-3 text-center">Passing Rate</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($coursePerformanceList)): ?>
                        <?php foreach ($coursePerformanceList as $row): ?>
                            <?php
                            $isCritical = $row['is_bottleneck'] ?? false;
                            $rate = $row['passing_rate'] ?? 0;
                            ?>
                            <tr class="ledger-row">
                                <td class="ps-3 fw-bold text-dark code-cell">
                                    <?= htmlspecialchars($row['course_code']) ?>
                                </td>
                                <td class="title-cell">
                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($row['course_title']) ?></div>
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i><?= htmlspecialchars($row['instructor'] ?? 'Faculty Instructor') ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['department'] ?? 'General') ?></span>
                                </td>
                                <td class="text-center fw-medium"><?= number_format($row['units'] ?? 3.0, 1) ?></td>
                                <td class="text-center fw-semibold"><?= number_format($row['enrolled'] ?? 0) ?></td>
                                <td class="text-center fw-bold <?= ($row['mean_gpa'] ?? 0) > 3.0 ? 'text-danger' : 'text-primary' ?>">
                                    <?= number_format($row['mean_gpa'] ?? 0, 2) ?>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold <?= $isCritical ? 'text-danger' : 'text-success' ?>">
                                        <?= number_format($rate, 1) ?>%
                                    </span>
                                    <div class="progress mt-1" style="height: 5px;">
                                        <div class="progress-bar <?= $isCritical ? 'bg-danger' : 'bg-success' ?>"
                                            role="progressbar" style="width: <?= $rate ?>%;"></div>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($isCritical): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Needs Help
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            <i class="bi bi-check-circle-fill me-1"></i> Normal
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="btn-group btn-group-sm">
                                        <a href="gradestracking?course_code=<?= urlencode($row['course_code']) ?>"
                                            class="btn btn-outline-dark" title="View Grades">
                                            <i class="bi bi-table"></i>
                                        </a>
                                        <a href="academicsupportprograms?course_code=<?= urlencode($row['course_code']) ?>"
                                            class="btn btn-outline-primary" title="Study Support">
                                            <i class="bi bi-mortarboard"></i>
                                        </a>
                                        <a href="failedincompletemonitoring?course_code=<?= urlencode($row['course_code']) ?>"
                                            class="btn btn-outline-danger" title="View Failed Students">
                                            <i class="bi bi-person-x"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No subject performance records found</p>
                                <small>No records found in the database. Please check your selected filter options.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- 5. CHART INITIALIZATION -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const courseLabels = <?= json_encode(array_column($coursePerformanceList, 'course_code')) ?>;
        const passingRates = <?= json_encode(array_column($coursePerformanceList, 'passing_rate')) ?>;

        // Bar Chart
        const ctxBar = document.getElementById('coursePassingBarChart');
        if (ctxBar && courseLabels.length > 0 && typeof Chart !== 'undefined') {
            new Chart(ctxBar.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: courseLabels,
                    datasets: [
                        {
                            label: 'Passing Rate (%)',
                            data: passingRates,
                            backgroundColor: passingRates.map(rate => rate < 85.0 ? 'rgba(220, 53, 69, 0.75)' : 'rgba(25, 135, 84, 0.75)'),
                            borderColor: passingRates.map(rate => rate < 85.0 ? '#dc3545' : '#198754'),
                            borderWidth: 1.5,
                            borderRadius: 4
                        },
                        {
                            type: 'line',
                            label: 'Target Goal (85%)',
                            data: courseLabels.map(() => 85.0),
                            borderColor: '#58111a',
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
                        }
                    }
                }
            });
        }

        // Doughnut Chart
        const ctxPie = document.getElementById('gradeDistributionPieChart');
        const dist = <?= json_encode($gradeDistribution) ?>;
        const totalGrades = (dist.honor || 0) + (dist.pass || 0) + (dist.risk || 0) + (dist.fail || 0);

        if (ctxPie && totalGrades > 0 && typeof Chart !== 'undefined') {
            new Chart(ctxPie.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Honor (≤ 1.75)', 'Regular Pass (2.00 - 3.00)', 'Deficient (Fail / INC)'],
                    datasets: [{
                        data: [dist.honor || 0, dist.pass || 0, (dist.risk + dist.fail) || 0],
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
    });

    // Simple Table Search Filter
    function filterLedgerTable() {
        const input = document.getElementById('tableSearchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.ledger-row');

        rows.forEach(row => {
            const code = row.querySelector('.code-cell')?.innerText.toLowerCase() || '';
            const title = row.querySelector('.title-cell')?.innerText.toLowerCase() || '';
            if (code.includes(input) || title.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>