<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">


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


    <!-- 4. SUBJECT-BY-SUBJECT LIST -->
    <div class="card border rounded-3 shadow-sm bg-white mb-3">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-journal-text me-1"></i> Subject Performance List
            </h6>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="tableSearchInput" class="form-control form-control-sm"
                    placeholder="Search subject code or title..." style="width: 250px;">
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
        <!-- Server-Side Table Pagination -->
        <?= $pagination['html'] ?? '' ?>
    </div>

</div>