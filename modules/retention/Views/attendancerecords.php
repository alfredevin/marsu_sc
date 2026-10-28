<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 3 - Attendance and Engagement Monitoring
 * View: Daily Roll-Call Attendance & Session Telemetry (attendancerecords.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .badge-att-p { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
        .badge-att-a { background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }
        .badge-att-e { background-color: #cff4fc; color: #055160; border: 1px solid #b6effb; }
        .badge-att-l { background-color: #fff3cd; color: #664d03; border: 1px solid #ffecb5; }
    </style>

    <!-- Header & Context Banner -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                    <i class="bi bi-calendar-check me-1"></i> Student Attendance Records & Roll-Call Monitoring
                </h6>
                <span class="badge bg-primary-subtle text-primary border border-primary px-2 py-1">
                    <i class="bi bi-calendar3 me-1"></i><?= htmlspecialchars($ayLabel ?? 'Academic Year 2026-2027') ?> • <?= htmlspecialchars($semName ?? '1st Semester') ?>
                </span>
                <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                    <i class="bi bi-shield-check me-1"></i>CHED 20% Maximum Absence Rule Enforced
                </span>
            </div>
            <small class="text-muted">
                Centralized university roll-call ledger tracking cumulative class attendance, unexcused cuts, excused clinic slips, and early warning risk thresholds.
            </small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print Roster
            </button>
            <?php if (can('retention.faculty.attendance')): ?>
            <button type="button" class="btn btn-sm marsu-maroon-bg text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#recordAttendanceModal">
                <i class="bi bi-plus-lg me-1"></i> Log Session Attendance
            </button>
            <?php endif; ?>
        </div>
    </div>

    <!-- KPI Metric Summary Cards -->
    <div class="row g-2 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border rounded-3 shadow-sm p-3 bg-white kpi-border-primary">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Cohort Attendance</div>
                        <h4 class="fw-bold text-dark mb-0 mt-1"><?= ($cohortRate > 0) ? number_format($cohortRate, 1) . '%' : 'N/A' ?></h4>
                        <small class="text-muted"><?= ($cohortRate > 0) ? '<i class="bi bi-arrow-up-right text-success me-1"></i>Active cohort rate' : 'No attendance logged yet' ?></small>
                    </div>
                    <div class="p-2 bg-primary-subtle text-primary rounded-2">
                        <i class="bi bi-speedometer2 fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border rounded-3 shadow-sm p-3 bg-white kpi-border-success">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">In Good Standing</div>
                        <h4 class="fw-bold text-success mb-0 mt-1"><?= number_format($compliantCount ?? 0) ?></h4>
                        <small class="text-muted">Compliant (&ge; 88% rate)</small>
                    </div>
                    <div class="p-2 bg-success-subtle text-success rounded-2">
                        <i class="bi bi-check2-circle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border rounded-3 shadow-sm p-3 bg-white kpi-border-warning">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Warning / Monitored</div>
                        <h4 class="fw-bold text-warning mb-0 mt-1"><?= number_format($monitoredCount ?? 0) ?></h4>
                        <small class="text-muted">Nearing cut limit (80% - 87.9%)</small>
                    </div>
                    <div class="p-2 bg-warning-subtle text-warning rounded-2">
                        <i class="bi bi-exclamation-triangle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border rounded-3 shadow-sm p-3 bg-white kpi-border-danger">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Critical Risk (CHED Alert)</div>
                        <h4 class="fw-bold text-danger mb-0 mt-1"><?= number_format($criticalCount ?? 0) ?></h4>
                        <small class="text-danger">&gt;20% cuts (&lt; 80% rate)</small>
                    </div>
                    <div class="p-2 bg-danger-subtle text-danger rounded-2">
                        <i class="bi bi-person-x-fill fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Filters Form -->
    <div class="card border rounded-3 bg-light shadow-sm p-3 mb-4">
        <form method="GET" action="<?= url('retention/attendancerecords') ?>" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-secondary mb-1">SEARCH STUDENT</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" name="q" class="form-control" placeholder="Search ID or Name..." value="<?= htmlspecialchars($search ?? '') ?>">
                </div>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">PROGRAM / DEGREE</label>
                <select name="department" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach (($departments ?? ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSIT', 'BSCS']) as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">YEAR LEVEL</label>
                <select name="year_level" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Years</option>
                    <option value="1" <?= (isset($yearLevel) && $yearLevel === '1') ? 'selected' : '' ?>>1st Year</option>
                    <option value="2" <?= (isset($yearLevel) && $yearLevel === '2') ? 'selected' : '' ?>>2nd Year</option>
                    <option value="3" <?= (isset($yearLevel) && $yearLevel === '3') ? 'selected' : '' ?>>3rd Year</option>
                    <option value="4" <?= (isset($yearLevel) && $yearLevel === '4') ? 'selected' : '' ?>>4th Year</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">COURSE / SUBJECT SCOPE</label>
                <select name="subject_code" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Enrolled Courses (Consolidated Term Load)</option>
                    <?php if (!empty($subjects)): ?>
                        <?php foreach ($subjects as $sb): ?>
                            <option value="<?= htmlspecialchars($sb['code']) ?>" <?= (isset($subjectCode) && $subjectCode === $sb['code']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($sb['code']) ?> - <?= htmlspecialchars($sb['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">COMPLIANCE LEVEL</label>
                <select name="compliance" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Compliance Levels</option>
                    <option value="compliant" <?= (isset($complianceFilter) && $complianceFilter === 'compliant') ? 'selected' : '' ?>>Compliant (&ge; 88%)</option>
                    <option value="monitored" <?= (isset($complianceFilter) && $complianceFilter === 'monitored') ? 'selected' : '' ?>>Monitored (80% - 87.9%)</option>
                    <option value="chronic" <?= (isset($complianceFilter) && $complianceFilter === 'chronic') ? 'selected' : '' ?>>Critical Risk (&lt; 80%)</option>
                </select>
            </div>

            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-dark flex-grow-1" title="Apply Filter"><i class="bi bi-funnel"></i></button>
                <a href="<?= url('retention/attendancerecords') ?>" class="btn btn-sm btn-outline-secondary" title="Reset Filters"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
    </div>

    <!-- Attendance Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h6 class="m-0 fw-bold marsu-maroon-text">
                    <i class="bi bi-person-lines-fill me-1"></i> Student Attendance Roster & Compliance Ledger
                </h6>
                <small class="text-muted">
                    Showing <?= number_format($totalStudents ?? 0) ?> monitored student records for <?= htmlspecialchars($ayLabel ?? 'Academic Year 2026-2027') ?> (<?= htmlspecialchars($semName ?? '1st Semester') ?>).
                    <?= !empty($subjectCode) ? 'Filtered by course: <strong>' . htmlspecialchars($subjectCode) . '</strong>' : 'Covering all enrolled semester courses term-to-date.' ?>
                </small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="attendanceSearchInput" class="form-control form-control-sm" placeholder="Quick search table..." style="width: 220px;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="attendanceTable" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3" style="width: 130px;">Student ID</th>
                        <th class="py-3">Student Name</th>
                        <th class="py-3" style="width: 140px;">Program & Section</th>
                        <th class="py-3 text-center" style="width: 110px;">Enrolled Load</th>
                        <th class="py-3 text-center" style="width: 130px;">Class Meetings</th>
                        <th class="py-3 text-center" style="width: 80px;">Present</th>
                        <th class="py-3 text-center" style="width: 100px;">Unexcused Cuts</th>
                        <th class="py-3 text-center" style="width: 80px;">Excused</th>
                        <th class="py-3 text-center" style="width: 80px;">Late</th>
                        <th class="py-3" style="width: 150px;">Attendance Rate</th>
                        <th class="py-3 text-center" style="width: 140px;">CHED 20% Status</th>
                        <th class="py-3 text-end pe-3" style="width: 90px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($attendanceList)): ?>
                        <?php foreach ($attendanceList as $std): ?>
                            <?php
                            $rate = $std['attendance_rate'];
                            $rateBarClass = 'bg-success';
                            if ($rate !== null) {
                                if ($rate < 80.0) {
                                    $rateBarClass = 'bg-danger';
                                } elseif ($rate < 88.0) {
                                    $rateBarClass = 'bg-warning text-dark';
                                }
                            }
                            ?>
                            <tr class="attendance-row">
                                <td class="ps-3 font-monospace fw-semibold text-secondary">
                                    <?= htmlspecialchars($std['student_number'] ?? '') ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($std['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted font-monospace"><?= htmlspecialchars($std['student_number'] ?? '') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border">
                                        <?= htmlspecialchars($std['program_code'] ?? 'BSIS') ?> <?= htmlspecialchars((string)($std['year_level'] ?? '1')) ?>-<?= htmlspecialchars($std['section_name'] ?? 'A') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">
                                        <?= htmlspecialchars((string)($std['enrolled_courses_count'] ?? 0)) ?> Course<?= ($std['enrolled_courses_count'] ?? 0) == 1 ? '' : 's' ?>
                                    </span>
                                </td>
                                <td class="text-center font-monospace text-secondary fw-semibold">
                                    <?= htmlspecialchars((string)($std['total_sessions'] ?? 0)) ?> Conducted
                                </td>
                                <td class="text-center font-monospace text-success fw-bold">
                                    <?= htmlspecialchars((string)($std['present_count'] ?? 0)) ?>
                                </td>
                                <td class="text-center font-monospace">
                                    <?php $cuts = (int)($std['absent_count'] ?? 0); ?>
                                    <?php if ($cuts >= 4): ?>
                                        <span class="badge bg-danger text-white px-2 py-1 fw-bold"><?= $cuts ?> Cuts</span>
                                    <?php elseif ($cuts >= 3): ?>
                                        <span class="badge bg-warning text-dark px-2 py-1 fw-bold"><?= $cuts ?> Cuts</span>
                                    <?php else: ?>
                                        <span class="text-secondary"><?= $cuts ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center font-monospace text-info">
                                    <?= htmlspecialchars((string)($std['excused_count'] ?? 0)) ?>
                                </td>
                                <td class="text-center font-monospace text-muted">
                                    <?= htmlspecialchars((string)($std['late_count'] ?? 0)) ?>
                                </td>
                                <td>
                                    <?php if ($rate !== null): ?>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress flex-grow-1" style="height: 6px;">
                                                <div class="progress-bar <?= $rateBarClass ?>" role="progressbar" style="width: <?= min(100, $rate) ?>%;"></div>
                                            </div>
                                            <span class="small font-monospace fw-semibold"><?= number_format($rate, 1) ?>%</span>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge bg-light text-secondary border font-monospace" style="font-size: 11px;">No Logs Yet</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= htmlspecialchars($std['compliance_badge'] ?? 'bg-success') ?>">
                                        <?= htmlspecialchars($std['compliance_status'] ?? 'Compliant') ?>
                                    </span>
                                    <div class="small text-muted mt-1" style="font-size: 11px;">
                                        <?= htmlspecialchars($std['ched_note'] ?? 'In Good Standing') ?>
                                    </div>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="<?= url('retention/profile?student_id=' . urlencode($std['student_number'] ?? '')) ?>" class="btn btn-xs btn-outline-primary" title="View Student Academic Dossier">
                                        Profile
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No attendance records found matching filters</p>
                                <small>Try adjusting your search query, program, or subject dropdown.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Server-Side Table Pagination -->
        <?= $pagination['html'] ?? '' ?>
    </div>

    <!-- Recent Attendance Sessions Ledger (Admin Voiding Oversight - Part E7) -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h6 class="m-0 fw-bold marsu-maroon-text">
                    <i class="bi bi-clock-history me-1"></i> Recent Class Roll-Call Sessions
                </h6>
                <small class="text-muted">
                    Session-level attendance telemetry. Authorized module administrators can void erroneous logs with formal audit justification.
                </small>
            </div>
            <span class="badge bg-light text-secondary border">Recent 50 Sessions</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-2" style="width: 80px;">Log #</th>
                        <th class="py-2">Date</th>
                        <th class="py-2">Student</th>
                        <th class="py-2">Course & Section</th>
                        <th class="py-2 text-center">Status</th>
                        <th class="py-2">Remarks</th>
                        <th class="py-2">Recorded By</th>
                        <th class="py-2 text-end pe-3" style="width: 110px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentSessions)): ?>
                        <?php foreach ($recentSessions as $sess): ?>
                            <?php
                            $sBadge = 'bg-success';
                            if ($sess['status'] === 'Absent') $sBadge = 'bg-danger text-white';
                            elseif ($sess['status'] === 'Excused') $sBadge = 'bg-info text-dark';
                            elseif ($sess['status'] === 'Late') $sBadge = 'bg-warning text-dark';
                            ?>
                            <tr>
                                <td class="ps-3 fw-bold text-secondary">#<?= (int) $sess['id'] ?></td>
                                <td class="text-nowrap"><?= date('M d, Y', strtotime($sess['session_date'])) ?></td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= e(($sess['first_name'] ?? '') . ' ' . ($sess['last_name'] ?? '')) ?></div>
                                    <small class="text-muted font-monospace"><?= e($sess['student_id']) ?></small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= e($sess['display_subject_code']) ?></span>
                                    <small class="text-muted d-block"><?= e($sess['section_name'] ?? '-') ?></small>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $sBadge ?> px-2 py-1"><?= e($sess['status']) ?></span>
                                </td>
                                <td>
                                    <small class="text-muted text-truncate d-block" style="max-width: 200px;" title="<?= e($sess['remarks'] ?? '') ?>">
                                        <?= e($sess['remarks'] ?: 'None') ?>
                                    </small>
                                </td>
                                <td>
                                    <small class="text-dark"><?= e($sess['recorded_by_name'] ?? 'Faculty') ?></small>
                                </td>
                                <td class="text-end pe-3">
                                    <?php if (can('retention.admin.attendance')): ?>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger py-0 px-2" 
                                                onclick="openVoidModal(<?= (int) $sess['id'] ?>, '<?= e(addslashes(($sess['first_name'] ?? '') . ' ' . ($sess['last_name'] ?? ''))) ?>', '<?= e(addslashes($sess['display_subject_code'])) ?>', '<?= e($sess['session_date']) ?>')">
                                            <i class="bi bi-trash3 me-1"></i> Void
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted small">Read-Only</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <small>No individual session records found.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (can('retention.faculty.attendance')): ?>
<!-- Modal: Log Roll-Call Attendance Session -->
<div class="modal fade" id="recordAttendanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header marsu-maroon-bg text-white">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-calendar-plus me-1"></i> Log Roll-Call Attendance Session
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" value="attendance">
                <div class="modal-body p-4 bg-light">
                    <div class="alert alert-info py-2 small mb-3">
                        <i class="bi bi-info-circle me-1"></i> Logging attendance will record session telemetry into <strong>ret_attendance_records</strong> for <?= htmlspecialchars($ayLabel ?? 'Academic Year 2026-2027') ?> (<?= htmlspecialchars($semName ?? '1st Semester') ?>) and automatically trigger early warning risk checks if unexcused absences exceed policy limits.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT NUMBER / ID <span class="text-danger">*</span></label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 26S0016" required>
                            <small class="text-muted">Enter valid MarSU student number (e.g. 26S0016).</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">SESSION DATE <span class="text-danger">*</span></label>
                            <input type="date" name="session_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">COURSE / SUBJECT <span class="text-danger">*</span></label>
                            <select name="subject_code" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Select Course...</option>
                                <?php if (!empty($subjects)): ?>
                                    <?php foreach ($subjects as $sb): ?>
                                        <option value="<?= htmlspecialchars($sb['code']) ?>">
                                            <?= htmlspecialchars($sb['code']) ?> - <?= htmlspecialchars($sb['title']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="CC111">CC111 - Introduction to Computing</option>
                                    <option value="CC112">CC112 - Computer Programming 1</option>
                                    <option value="IT211">IT211 - Data Structures</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">ATTENDANCE STATUS <span class="text-danger">*</span></label>
                            <select name="status" class="form-select form-select-sm" required>
                                <option value="Present" selected>Present (In Class)</option>
                                <option value="Absent">Absent (Unexcused Cut)</option>
                                <option value="Excused">Excused (Medical Certificate / Official Permit)</option>
                                <option value="Late">Late (Tardy Entry)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">REMARKS / JUSTIFICATION</label>
                        <textarea name="remarks" class="form-control form-control-sm" rows="2" placeholder="Optional remarks (e.g., excused via University Health Center clinic pass, athletics tournament participation)..."></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm marsu-maroon-bg text-white px-4 fw-semibold">Save Attendance Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Include Reason Modal Partial for Administrative Voiding -->
<?php include __DIR__ . '/partials/reason_modal.php'; ?>

<script>
    // Quick Client-Side Table Filter
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('attendanceSearchInput');
        if (!searchInput) return;

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#attendanceTable tbody tr.attendance-row');

            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    });

    window.openVoidModal = function(id, studentName, subject, date) {
        document.getElementById('reasonModalLabel').innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Void Attendance Record #' + id;
        document.getElementById('reasonModalDescription').innerHTML = 'You are about to void the <strong>' + subject + '</strong> session on <strong>' + date + '</strong> for <strong>' + studentName + '</strong>. This will soft-delete the record and remove its impact on attendance metrics.';
        document.getElementById('reasonModalForm').action = '<?= url('retention/admin/attendance') ?>/' + id + '/void';
        document.getElementById('reasonModalSubmitBtn').className = 'btn btn-danger btn-sm';
        document.getElementById('reasonModalSubmitBtn').innerHTML = '<i class="bi bi-trash3 me-1"></i>Confirm Void Record';
        new bootstrap.Modal(document.getElementById('reasonModal')).show();
    };
</script>