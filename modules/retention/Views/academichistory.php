<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

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

        .kpi-border-warning {
            border-left: 4px solid #ffc107 !important;
        }

        .kpi-border-danger {
            border-left: 4px solid #dc3545 !important;
        }
    </style>

    <?php if (!empty($selectedStudent)): ?>
        <!-- ===================================================================== -->
        <!-- STATE 2: STUDENT ACADEMIC TRANSCRIPT & GWA TRAJECTORY DOSSIER        -->
        <!-- ===================================================================== -->

        <!-- Top Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="academichistory" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Scholastic Roster
                </a>
                <span class="text-muted">|</span>
                <span class="small fw-bold text-secondary">Scholastic Transcript & Term GPA Ledger</span>
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print Transcript Summary
                </button>
            </div>
        </div>

        <!-- Academic Summary Banner Card -->
        <div class="card border rounded-3 shadow-sm mb-4 bg-white">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($selectedStudent['full_name']) ?></h5>
                        <div class="d-flex flex-wrap align-items-center gap-2 small text-muted">
                            <span class="badge bg-light text-secondary border px-2 py-1">
                                <i class="bi bi-person-badge me-1"></i>
                                <?= htmlspecialchars($selectedStudent['student_number']) ?>
                            </span>
                            <span>•</span>
                            <span class="fw-semibold text-dark"><?= htmlspecialchars($selectedStudent['program_name']) ?>
                                (<?= htmlspecialchars($selectedStudent['program_code']) ?>)</span>
                            <span>•</span>
                            <span>Year <?= htmlspecialchars((string) ($selectedStudent['year_level'] ?? 1)) ?> -
                                <?= htmlspecialchars($selectedStudent['section_name'] ?? '-') ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Standing Badge Base sa GWA -->
                        <?php if ($cumulativeGwa > 0 && $cumulativeGwa <= 1.75): ?>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-7">
                                <i class="bi bi-award-fill me-1"></i> Dean's Lister Tier (Honor)
                            </span>
                        <?php elseif ($cumulativeGwa > 0 && $cumulativeGwa <= 3.00 && $totalFailedUnits == 0): ?>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 fs-7">
                                <i class="bi bi-check-circle-fill me-1"></i> Good Academic Standing
                            </span>
                        <?php elseif ($totalFailedUnits > 0 || $cumulativeGwa > 3.00): ?>
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 fs-7">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> Scholastic Deficiency / Probation
                            </span>
                        <?php else: ?>
                            <span class="badge bg-light text-secondary border px-3 py-2 fs-7">
                                Enrolled / Monitored
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 4 Quick Scholastic Stat Boxes -->
                <div class="row g-2 mt-3 pt-3 border-top">
                    <div class="col-sm-3 col-6">
                        <small class="text-muted d-block">Cumulative GWA</small>
                        <h4 class="fw-bold mb-0 <?= ($cumulativeGwa > 3.00) ? 'text-danger' : 'text-primary' ?>">
                            <?= ($cumulativeGwa > 0) ? number_format($cumulativeGwa, 2) : 'N/A' ?>
                        </h4>
                    </div>
                    <div class="col-sm-3 col-6">
                        <small class="text-muted d-block">Units Passed</small>
                        <h4 class="fw-bold mb-0 text-success"><?= number_format($totalEarnedUnits, 1) ?></h4>
                    </div>
                    <div class="col-sm-3 col-6">
                        <small class="text-muted d-block">Failed Units</small>
                        <h4 class="fw-bold mb-0 <?= ($totalFailedUnits > 0) ? 'text-danger' : 'text-muted' ?>">
                            <?= number_format($totalFailedUnits, 1) ?>
                        </h4>
                    </div>
                    <div class="col-sm-3 col-6">
                        <small class="text-muted d-block">Retention Actions</small>
                        <div class="d-flex gap-1 mt-1">
                            <a href="guidancereferrals?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                class="btn btn-xs btn-outline-warning text-dark" title="Refer to Guidance">
                                <i class="bi bi-person-heart"></i>
                            </a>
                            <a href="academicsupportprograms?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                class="btn btn-xs btn-outline-primary" title="Endorse to Peer Tutoring">
                                <i class="bi bi-mortarboard"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Term-by-Term Course Breakdown -->
        <?php if (!empty($groupedRecords)): ?>
            <?php foreach ($groupedRecords as $term): ?>
                <div class="card border rounded-3 shadow-sm mb-3 bg-white">
                    <div class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <span class="fw-bold text-dark"><i class="bi bi-calendar-check me-1 text-primary"></i>
                                <?= htmlspecialchars($term['term_label']) ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 small">
                            <span class="badge bg-white text-dark border">Term Units:
                                <strong><?= number_format($term['term_units'], 1) ?></strong></span>
                            <span class="badge bg-white text-dark border">Passed:
                                <strong><?= number_format($term['passed_units'], 1) ?></strong></span>
                            <span
                                class="badge <?= ($term['term_gpa'] > 3.00) ? 'bg-danger text-white' : 'bg-primary text-white' ?>">
                                Term GPA:
                                <strong><?= ($term['term_gpa'] > 0) ? number_format($term['term_gpa'], 2) : 'N/A' ?></strong>
                            </span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                            <thead class="table-light text-uppercase small text-muted">
                                <tr>
                                    <th class="ps-3 py-2">Course Code</th>
                                    <th class="py-2">Course Title</th>
                                    <th class="py-2 text-center">Units</th>
                                    <th class="py-2 text-center">Final Grade</th>
                                    <th class="py-2 text-center">Remarks</th>
                                    <th class="py-2 text-end pe-3">Curricular Flag</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($term['records'] as $rec): ?>
                                    <?php
                                    $gVal = trim((string) ($rec['grade'] ?? ''));
                                    $isFailed = ($gVal === '5.00' || $gVal === '5.0' || (is_numeric($gVal) && (float) $gVal > 3.00));
                                    $isInc = (strtoupper($gVal) === 'INC');
                                    ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-secondary"><?= htmlspecialchars($rec['course_code']) ?></td>
                                        <td class="fw-semibold text-dark">
                                            <?= htmlspecialchars($rec['course_title'] ?? 'Subject Title') ?></td>
                                        <td class="text-center"><?= number_format($rec['units'] ?? 3.0, 1) ?></td>
                                        <td
                                            class="text-center fw-bold fs-6 <?= $isFailed ? 'text-danger' : ($isInc ? 'text-warning' : 'text-primary') ?>">
                                            <?= htmlspecialchars($gVal ?: 'N/A') ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($isFailed): ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">FAILED</span>
                                            <?php elseif ($isInc): ?>
                                                <span
                                                    class="badge bg-warning-subtle text-dark border border-warning-subtle">INCOMPLETE</span>
                                            <?php else: ?>
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle">PASSED</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end pe-3">
                                            <?php if ($isFailed): ?>
                                                <span class="badge bg-danger text-white">Prerequisite Blocked</span>
                                            <?php elseif ($isInc): ?>
                                                <span class="badge bg-warning text-dark">Removal Required</span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-secondary border">Credited</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card border rounded-3 p-5 text-center bg-white shadow-sm">
                <i class="bi bi-journal-x fs-1 text-secondary mb-2"></i>
                <h6 class="fw-bold text-dark">No official academic course records encoded yet</h6>
                <p class="text-muted small mb-0">Grade records for this student have not yet been synchronized from the faculty
                    class records.</p>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <!-- ===================================================================== -->
        <!-- STATE 1: COHORT SCHOLASTIC OVERVIEW ROSTER (UNANG SCREEN)            -->
        <!-- ===================================================================== -->

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">Student Scholastic History Roster</h6>
                <small class="text-muted">Longitudinal transcript audits, cumulative GWA standings, and course completion
                    logs.</small>
            </div>

            <form method="GET" action="" id="searchForm" class="d-flex gap-2 align-items-center flex-wrap ms-auto">
                <!-- Search Box na may Automatic Backspace Clear -->
                <div class="input-group input-group-sm" style="width: 220px;">
                    <input type="search" id="searchInput" name="q" class="form-control" placeholder="Search ID / Name..."
                        value="<?= htmlspecialchars($search ?? '') ?>" oninput="handleSearch(this)" autocomplete="off">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>

                <!-- Program Filter -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">PROGRAM:</label>
                <select name="department" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Year Level Filter -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">YEAR:</label>
                <select name="year_level" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Year Levels</option>
                    <option value="1" <?= (isset($yearLevel) && $yearLevel === '1') ? 'selected' : '' ?>>1st Year</option>
                    <option value="2" <?= (isset($yearLevel) && $yearLevel === '2') ? 'selected' : '' ?>>2nd Year</option>
                    <option value="3" <?= (isset($yearLevel) && $yearLevel === '3') ? 'selected' : '' ?>>3rd Year</option>
                    <option value="4" <?= (isset($yearLevel) && $yearLevel === '4') ? 'selected' : '' ?>>4th Year</option>
                </select>

                <!-- Section Filter -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">SECTION:</label>
                <select name="section" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Sections</option>
                    <?php foreach ($sections as $sec): ?>
                        <option value="<?= htmlspecialchars($sec) ?>" <?= (isset($section) && $section === $sec) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sec) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if (!empty($department) || !empty($yearLevel) || !empty($section) || !empty($search)): ?>
                    <a href="academichistory" class="btn btn-sm btn-outline-danger" title="Clear Filters">
                        <i class="bi bi-x-circle"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Roster Table Display -->
        <div class="table-responsive bg-white rounded border shadow-sm">
            <table class="table table-hover align-middle mb-0" id="academicRosterTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student ID</th>
                        <th class="py-3">Student Name & Identity</th>
                        <th class="py-3">Degree Program</th>
                        <th class="py-3">Year & Section</th>
                        <th class="py-3 text-center">Enrollment Status</th>
                        <th class="py-3 text-end pe-3">Scholastic Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($studentList)): ?>
                        <?php foreach ($studentList as $row): ?>
                            <tr class="student-row">
                                <td class="ps-3 fw-semibold text-secondary col-id">
                                    <?= htmlspecialchars($row['student_number'] ?? $row['id']) ?>
                                </td>
                                <td class="col-name">
                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><i class="bi bi-shield-check me-1 text-success"></i>Verified
                                        Student</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= htmlspecialchars($row['program_code'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td>
                                    Year <?= htmlspecialchars((string) ($row['year_level'] ?? 1)) ?> - <span
                                        class="fw-semibold text-dark"><?= htmlspecialchars($row['section_name'] ?? '-') ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle text-capitalize">
                                        <?= htmlspecialchars($row['enrollment_status'] ?? 'Enrolled') ?>
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <!-- PINDUTIN PARA BUMUKAS ANG TERM-BY-TERM TRANSCRIPT -->
                                    <a href="academichistory?student_id=<?= urlencode($row['student_number'] ?? $row['id']) ?>"
                                        class="btn btn-sm btn-outline-primary fw-semibold">
                                        View Transcript
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No student scholastic records found</p>
                                <small>No students matched the active search or filter selection.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <script>
            const hadQuery = <?= !empty($search) ? 'true' : 'false' ?>;

            function handleSearch(input) {
                const query = input.value.trim().toLowerCase();
                const rows = document.querySelectorAll('.student-row');

                // Live filter sa table habang nagta-type
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = (query === '' || text.includes(query)) ? '' : 'none';
                });

                // Kusa mag-reload kapag binura gamit ang backspace
                if (query === '' && hadQuery) {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('q');
                    window.location.href = url.toString();
                }
            }

            // Kapag pinindot ang (x) icon sa search box
            const sBox = document.getElementById('searchInput');
            if (sBox) {
                sBox.addEventListener('search', function () {
                    if (this.value === '' && hadQuery) {
                        const url = new URL(window.location.href);
                        url.searchParams.delete('q');
                        window.location.href = url.toString();
                    }
                });
            }
        </script>

    <?php endif; ?>

</div>