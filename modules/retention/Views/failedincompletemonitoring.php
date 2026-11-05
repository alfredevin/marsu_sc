<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Failed & Incomplete (INC) Grades Monitoring (failedincompletemonitoring.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
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
                                            <?php if ($isInc && can('retention.admin.grades') && !empty($row['grade_id'])): ?>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item small text-warning"
                                                        onclick="openExtendIncModal(<?= (int) $row['grade_id'] ?>, '<?= e(addslashes($row['full_name'])) ?>', '<?= e(addslashes($row['course_code'])) ?>', '<?= e($row['removal_deadline'] ?? '') ?>')">
                                                        <i class="bi bi-calendar-plus me-2 text-warning"></i> Extend INC Deadline
                                                    </button>
                                                </li>
                                            <?php endif; ?>
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

<!-- Modal: Extend INC Deadline (Part E6) -->
<div class="modal fade" id="extendIncModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form id="extendIncForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-warning text-dark">
                    <h6 class="modal-title fw-bold mb-0">
                        <i class="bi bi-calendar-plus me-1"></i> Extend Incomplete (INC) Deadline
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="mb-3">
                        <span class="text-muted d-block small" style="font-size: 11px;">STUDENT & SUBJECT</span>
                        <div class="fw-bold text-dark" id="incStudentSubjectLabel"></div>
                        <small class="text-secondary">Current Deadline: <span class="fw-semibold text-danger" id="incCurrentDeadlineLabel"></span></small>
                    </div>

                    <div class="mb-3">
                        <label for="incNewDeadline" class="form-label small fw-bold text-dark">New Extension Deadline <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm" id="incNewDeadline" name="new_deadline" required min="<?= date('Y-m-d') ?>">
                        <small class="text-muted" style="font-size: 11px;">New removal completion deadline granted by academic administration.</small>
                    </div>

                    <div class="mb-3">
                        <label for="incReason" class="form-label small fw-bold text-dark">Administrative Justification <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" id="incReason" name="reason" rows="3" required minlength="10" placeholder="State official basis for extension (e.g., medical hospitalization certificate, thesis laboratory extension)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark px-3 fw-semibold">
                        <i class="bi bi-calendar-check me-1"></i> Save Extension
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
window.openExtendIncModal = function(gradeId, studentName, courseCode, currentDeadline) {
    document.getElementById('incStudentSubjectLabel').textContent = studentName + ' (' + courseCode + ')';
    document.getElementById('incCurrentDeadlineLabel').textContent = currentDeadline || 'Not Set';
    document.getElementById('extendIncForm').action = '<?= url('retention/admin/grades') ?>/' + gradeId + '/extend-inc';
    new bootstrap.Modal(document.getElementById('extendIncModal')).show();
};
</script>