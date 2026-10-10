<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
    </style>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-calendar-check me-1"></i> Student Attendance Records & Roll-Call Monitoring
            </h6>
            <small class="text-muted">Biometric & roll-call session summaries, unexcused absence monitoring, and attendance compliance rates.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Print Roster
            </button>
            <button type="button" class="btn btn-sm marsu-maroon-bg text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#recordAttendanceModal">
                <i class="bi bi-plus-lg me-1"></i> Log Session Attendance
            </button>
        </div>
    </div>

    <!-- Active Filters Form -->
    <div class="card border rounded-3 bg-light shadow-sm p-3 mb-4">
        <form method="GET" action="" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-secondary mb-1">SEARCH STUDENT</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" name="q" class="form-control" placeholder="Search ID or Name..." value="<?= htmlspecialchars($search ?? '') ?>">
                </div>
            </div>
            <div class="col-md-3">
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
                <label class="form-label small fw-semibold text-secondary mb-1">SECTION</label>
                <select name="section" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Sections</option>
                    <?php foreach (($sections ?? ['Section A', 'Section B', 'Section C']) as $sec): ?>
                        <option value="<?= htmlspecialchars($sec) ?>" <?= (isset($section) && $section === $sec) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sec) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-dark flex-grow-1"><i class="bi bi-funnel me-1"></i> Filter</button>
                <a href="<?= url('retention/attendancerecords') ?>" class="btn btn-sm btn-outline-secondary" title="Reset Filters"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
    </div>

    <!-- 4 KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Cohort Attendance Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= htmlspecialchars((string) ($cohortRate ?? '91.8')) ?>%</h3>
                    <span class="badge bg-success-subtle text-success border border-success">Target &ge; 80%</span>
                </div>
                <small class="text-muted mt-2 d-block">Overall compliant class presence</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-danger">
                <span class="text-muted small fw-semibold text-uppercase">Chronic Absenteeism Flag</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= htmlspecialchars((string) ($chronicCount ?? 0)) ?></h3>
                    <span class="badge bg-danger-subtle text-danger border border-danger">Risk Breached</span>
                </div>
                <small class="text-muted mt-2 d-block">Absences &gt; 20% limit (&lt; 80% attendance)</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">Excused Absences</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= htmlspecialchars((string) ($excusedCount ?? 0)) ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Verified Slips</span>
                </div>
                <small class="text-muted mt-2 d-block">Clinic & formal excuse slips filed</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Monitored Cohort Roster</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= htmlspecialchars((string) ($totalStudents ?? count($attendanceList ?? []))) ?></h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">Active Students</span>
                </div>
                <small class="text-muted mt-2 d-block">Total matching cohort enrollment</small>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-person-lines-fill me-1"></i> Student Roll-Call Attendance Ledger
            </h6>
            <span class="badge bg-light text-dark border">Showing <?= count($attendanceList ?? []) ?> records</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3" style="width: 140px;">Student Number</th>
                        <th class="py-3">Student Name</th>
                        <th class="py-3">Program & Section</th>
                        <th class="py-3 text-center" style="width: 130px;">Present Sessions</th>
                        <th class="py-3 text-center" style="width: 130px;">Unexcused Absences</th>
                        <th class="py-3 text-center" style="width: 110px;">Excused</th>
                        <th class="py-3" style="width: 170px;">Attendance Rate</th>
                        <th class="py-3 text-center" style="width: 130px;">Compliance</th>
                        <th class="py-3 text-end pe-3" style="width: 110px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($attendanceList)): ?>
                        <?php foreach ($attendanceList as $std): ?>
                            <?php
                            $rate = (float) ($std['attendance_rate'] ?? 90.0);
                            $rateBadge = 'bg-success';
                            $statusText = 'Compliant';
                            $statusBadge = 'bg-success-subtle text-success border border-success';
                            if ($rate < 80.0) {
                                $rateBadge = 'bg-danger';
                                $statusText = 'Chronic Absent';
                                $statusBadge = 'bg-danger-subtle text-danger border border-danger';
                            } elseif ($rate < 88.0) {
                                $rateBadge = 'bg-warning text-dark';
                                $statusText = 'Monitored';
                                $statusBadge = 'bg-warning-subtle text-dark border border-warning';
                            }
                            ?>
                            <tr>
                                <td class="ps-3 font-monospace fw-semibold text-secondary">
                                    <?= htmlspecialchars($std['student_number'] ?? '') ?>
                                </td>
                                <td class="fw-bold text-dark">
                                    <?= htmlspecialchars($std['full_name'] ?? 'N/A') ?>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border">
                                        <?= htmlspecialchars($std['program_code'] ?? 'BSIS') ?> <?= htmlspecialchars((string)($std['year_level'] ?? '1')) ?>-<?= htmlspecialchars($std['section_name'] ?? 'A') ?>
                                    </span>
                                </td>
                                <td class="text-center font-monospace text-success fw-bold">
                                    <?= htmlspecialchars((string)($std['present_count'] ?? 28)) ?> / <?= htmlspecialchars((string)($std['total_sessions'] ?? 30)) ?>
                                </td>
                                <td class="text-center font-monospace <?= ($std['absent_count'] ?? 0) > 3 ? 'text-danger fw-bold' : 'text-secondary' ?>">
                                    <?= htmlspecialchars((string)($std['absent_count'] ?? 2)) ?>
                                </td>
                                <td class="text-center font-monospace text-info">
                                    <?= htmlspecialchars((string)($std['excused_count'] ?? 0)) ?>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 6px;">
                                            <div class="progress-bar <?= $rateBadge ?>" role="progressbar" style="width: <?= min(100, $rate) ?>%;"></div>
                                        </div>
                                        <span class="small font-monospace fw-semibold"><?= number_format($rate, 1) ?>%</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $statusBadge ?>"><?= $statusText ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($std['student_number'] ?? $std['id'] ?? '') ?>" class="btn btn-xs btn-outline-primary" title="View Student Dossier">
                                        Profile
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No attendance records found matching filters</p>
                                <small>Try adjusting your search criteria or program dropdown.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Log Session Attendance -->
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
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT NUMBER / ID</label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 23-1001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">SESSION DATE</label>
                            <input type="date" name="session_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">COURSE / SUBJECT CODE</label>
                            <input type="text" name="subject_code" class="form-control form-control-sm" placeholder="e.g. IT211" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">ATTENDANCE STATUS</label>
                            <select name="status" class="form-select form-select-sm" required>
                                <option value="Present" selected>Present</option>
                                <option value="Absent">Unexcused Absent</option>
                                <option value="Excused">Excused (With Clinic / Permit Slip)</option>
                                <option value="Late">Tardy / Late</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">REMARKS / EXPLANATION</label>
                        <textarea name="remarks" class="form-control form-control-sm" rows="2" placeholder="Optional notes (e.g. excused due to university athletics event)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm marsu-maroon-bg text-white px-4 fw-semibold">Save Attendance Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>