<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .kpi-border-danger {
            border-left: 4px solid #dc3545 !important;
        }

        .kpi-border-warning {
            border-left: 4px solid #ffc107 !important;
        }

        .kpi-border-info {
            border-left: 4px solid #0dcaf0 !important;
        }
    </style>

    <!-- 1. CONCISE HEADER & SINGLE-LINE FILTER BAR -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-exclamation-octagon-fill me-1"></i> Failed & Incomplete Subject Watchlist
            </h6>
            <small class="text-muted">Institutional tracking of course failures (5.00), Incomplete (INC) marks, and
                removal examination compliance.</small>
        </div>

        <form method="GET" action="" class="d-flex align-items-center gap-2 flex-wrap ms-auto">
            <!-- Program -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap">PROGRAM:</label>
            <select name="department" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <option value="">All Programs</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= htmlspecialchars($dept) ?>" <?= $department === $dept ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- School Year -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">SCHOOL YEAR:</label>
            <select name="school_year" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <?php foreach ($schoolYears as $sy): ?>
                    <option value="<?= htmlspecialchars($sy) ?>" <?= $schoolYear === $sy ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sy) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Semester -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">SEMESTER:</label>
            <select name="semester" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <option value="">All Semesters</option>
                <?php foreach ($semesters as $sem): ?>
                    <option value="<?= htmlspecialchars($sem) ?>" <?= $semester === $sem ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sem) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Deficiency Type -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">DEFICIENCY:</label>
            <select name="deficiency_type" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <option value="">All Types</option>
                <?php foreach ($deficiencyTypes as $dt): ?>
                    <option value="<?= htmlspecialchars($dt) ?>" <?= $deficiencyType === $dt ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dt) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print
            </button>
        </form>
    </div>

    <!-- 2. STRATEGIC DEFICIENCY KPI CARDS -->
    <div class="row g-3 mb-4">
        <!-- Total Deficiencies -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Total Deficiencies</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= $totalDeficiencies ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Active Watchlist</span>
                </div>
                <small class="text-muted mt-2 d-block">Total active failing (5.00) or incomplete records</small>
            </div>
        </div>

        <!-- Incomplete Marks (INC) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">Incomplete (INC) Marks</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $totalInc ?></h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">1-Year Window</span>
                </div>
                <small class="text-muted mt-2 d-block">Pending final examination or major requirement</small>
            </div>
        </div>

        <!-- Course Failures (5.00) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Course Failures (5.00)</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= $totalFailed ?></h3>
                    <span class="badge bg-light text-danger border border-danger">Retake Mandatory</span>
                </div>
                <small class="text-muted mt-2 d-block">Requires curricular re-enrollment & advising</small>
            </div>
        </div>

        <!-- Pending Removal Examinations -->
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Pending Resolutions</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= $totalPendingRem ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">In-Progress</span>
                </div>
                <small class="text-muted mt-2 d-block">Scheduled removal exams or pending completions</small>
            </div>
        </div>
    </div>

    <!-- 3. DEFICIENCY & REMOVAL TRACKING LEDGER TABLE -->
    <div class="card border rounded-3 shadow-sm bg-white mb-3">
        <div
            class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-clipboard2-x-fill me-1"></i> Active Deficiencies & Removal Tracking Ledger
            </h6>

            <div class="d-flex align-items-center gap-2">
                <!-- Filter Status Buttons -->
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-secondary active quick-filter-btn"
                        data-filter="all">All</button>
                    <button type="button" class="btn btn-outline-danger quick-filter-btn"
                        data-filter="Failed (5.00)">5.00 Failures</button>
                    <button type="button" class="btn btn-outline-warning text-dark quick-filter-btn"
                        data-filter="Incomplete (INC)">INC Marks</button>
                </div>

                <input type="text" id="defSearchInput" class="form-control form-control-sm"
                    placeholder="Search ID, Name, or Course..." style="width: 210px;" onkeyup="filterDeficiencyTable()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="deficiencyTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student ID</th>
                        <th class="py-3">Student Name</th>
                        <th class="py-3">Subject & Course</th>
                        <th class="py-3 text-center">Mark</th>
                        <th class="py-3 text-center">Deficiency Type</th>
                        <th class="py-3">Term Recorded</th>
                        <th class="py-3">Faculty In-Charge</th>
                        <th class="py-3 text-center">Resolution Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($deficienciesList)): ?>
                        <?php foreach ($deficienciesList as $row): ?>
                            <?php
                            $isFail = ($row['grade'] === '5.00' || $row['grade'] === '5.0');
                            $isInc = ($row['grade'] === 'INC');

                            $badgeClass = 'bg-danger-subtle text-danger border border-danger-subtle';
                            if ($isInc) {
                                $badgeClass = 'bg-warning-subtle text-dark border border-warning-subtle';
                            } elseif ($row['grade'] === 'DRP') {
                                $badgeClass = 'bg-secondary-subtle text-secondary border border-secondary-subtle';
                            }
                            ?>
                            <tr class="def-row" data-type="<?= htmlspecialchars($row['deficiency_type']) ?>">
                                <td class="ps-3 fw-bold text-secondary id-cell">
                                    <?= htmlspecialchars($row['student_id']) ?>
                                </td>
                                <td class="name-cell">
                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($row['full_name']) ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['department']) ?> • Year
                                        <?= htmlspecialchars($row['year_level']) ?>-<?= htmlspecialchars($row['section']) ?></small>
                                </td>
                                <td class="course-cell">
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($row['course_code']) ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['course_title']) ?></small>
                                </td>
                                <td
                                    class="text-center fw-bold fs-6 <?= $isFail ? 'text-danger' : ($isInc ? 'text-warning' : 'text-secondary') ?>">
                                    <?= htmlspecialchars($row['grade']) ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $badgeClass ?>">
                                        <?= htmlspecialchars($row['deficiency_type']) ?>
                                    </span>
                                </td>
                                <td class="small text-muted">
                                    <?= htmlspecialchars($row['term_recorded']) ?>
                                </td>
                                <td class="small text-dark">
                                    <i class="bi bi-person me-1"></i><?= htmlspecialchars($row['instructor']) ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-secondary border">
                                        <?= htmlspecialchars($row['resolution_status']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a class="dropdown-item small"
                                                    href="academichistory?student_id=<?= urlencode($row['student_id']) ?>">
                                                    <i class="bi bi-clock-history me-2 text-primary"></i> Academic History
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item small"
                                                    href="academicsupportprograms?course_code=<?= urlencode($row['course_code']) ?>&student_id=<?= urlencode($row['student_id']) ?>">
                                                    <i class="bi bi-mortarboard me-2 text-success"></i> Endorse to Peer Tutoring
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item small text-danger"
                                                    href="guidancereferrals?student_id=<?= urlencode($row['student_id']) ?>">
                                                    <i class="bi bi-person-exclamation me-2"></i> Refer to Guidance
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Standard MarSU Empty State Box -->
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No active failing or incomplete records found</p>
                                <small>All evaluated students are in good academic standing, or records have not yet synced
                                    from the central database.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Instant Search & Quick Filter Script -->
<script>
    function filterDeficiencyTable() {
        const input = document.getElementById('defSearchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.def-row');

        rows.forEach(row => {
            const idText = row.querySelector('.id-cell')?.innerText.toLowerCase() || '';
            const nameText = row.querySelector('.name-cell')?.innerText.toLowerCase() || '';
            const courseText = row.querySelector('.course-cell')?.innerText.toLowerCase() || '';
            if (idText.includes(input) || nameText.includes(input) || courseText.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Quick Button Filters (All, 5.00, INC)
    document.querySelectorAll('.quick-filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.quick-filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;

            document.querySelectorAll('.def-row').forEach(row => {
                if (filter === 'all' || row.dataset.type === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>