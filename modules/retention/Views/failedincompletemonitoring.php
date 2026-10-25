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

    <!-- 1. HEADER AND FILTERS -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-exclamation-octagon-fill me-1"></i> Failed and Incomplete Subject Watchlist
            </h6>
            <small class="text-muted">Track failed marks (5.00), incomplete grades (INC), and removal deadlines.</small>
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


    <!-- 3. DEFICIENCY LEDGER TABLE -->
    <div class="card border rounded-3 shadow-sm bg-white mb-3">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-clipboard2-x-fill me-1"></i> Active Deficiency Records
            </h6>

            <div class="d-flex align-items-center gap-2">
                <!-- Filter Status Buttons -->
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-secondary active quick-filter-btn" data-filter="all">All</button>
                    <button type="button" class="btn btn-outline-danger quick-filter-btn" data-filter="Failed (5.00)">5.00 Failures</button>
                    <button type="button" class="btn btn-outline-warning text-dark quick-filter-btn" data-filter="Incomplete (INC)">INC Marks</button>
                </div>

                    <input type="text" id="defSearchInput" class="form-control form-control-sm"
                        placeholder="Search ID, Name, or Subject..." style="width: 250px;">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="deficiencyTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student ID</th>
                        <th class="py-3">Student Name</th>
                        <th class="py-3">Subject</th>
                        <th class="py-3 text-center">Grade</th>
                        <th class="py-3 text-center">Deficiency Type</th>
                        <th class="py-3">Term Recorded</th>
                        <th class="py-3">Instructor</th>
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
                                <td class="text-center fw-bold fs-6 <?= $isFail ? 'text-danger' : ($isInc ? 'text-warning' : 'text-secondary') ?>">
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
                                                    <i class="bi bi-mortarboard me-2 text-success"></i> Study Support
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
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No active failing or incomplete records found</p>
                                <small>All evaluated students are in good academic standing, or no records matched the selected filters.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <!-- Server-Side Table Pagination -->
        <?= $pagination['html'] ?? '' ?>
    </div>

</div>