<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
        .kpi-border-danger { border-left: 4px solid #dc3545 !important; }
    </style>

    <!-- Header & Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-journal-check me-1"></i> Faculty & Academic Advising Records
            </h6>
            <small class="text-muted">Documentation of one-on-one academic consultation sessions, study plans, and mentoring logs.</small>
        </div>

        <div class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <form method="GET" action="" class="d-flex gap-2 align-items-center flex-wrap">
                <input type="search" name="q" class="form-control form-control-sm" placeholder="Search student or topic..." value="<?= htmlspecialchars($search ?? '') ?>" style="width: 180px;">
                <select name="department" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <button type="button" class="btn btn-sm marsu-maroon-bg text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#newAdvisingModal">
                <i class="bi bi-plus-lg me-1"></i> Log Advising Session
            </button>
        </div>
    </div>


    <!-- Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-journal-text me-1"></i> Academic Advising Session Ledger
            </h6>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="advisingSearchInput" class="form-control form-control-sm" placeholder="Search ID, Name, or Advisor..." style="width: 250px;">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="advisingTable" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student Details</th>
                        <th class="py-3">Program & Section</th>
                        <th class="py-3">Advising Date</th>
                        <th class="py-3">Topic / Subject Matter</th>
                        <th class="py-3">Advisor / Faculty</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($advisingList)): ?>
                        <?php foreach ($advisingList as $row): ?>
                            <tr class="advising-row">
                                <td class="ps-3 fw-semibold text-dark">
                                    <div><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($row['student_id'] ?? '') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['department'] ?? 'BSIS') ?></span>
                                    <small class="text-muted d-block">Year <?= htmlspecialchars((string)($row['year_level'] ?? 1)) ?></small>
                                </td>
                                <td>
                                    <i class="bi bi-calendar-event me-1 text-secondary"></i>
                                    <?= htmlspecialchars($row['advising_date'] ?? date('Y-m-d')) ?>
                                </td>
                                <td class="fw-medium text-dark">
                                    <?= htmlspecialchars($row['topic'] ?? 'Academic Progress Review') ?>
                                    <?php if (!empty($row['notes'])): ?>
                                        <small class="text-muted d-block text-truncate" style="max-width: 260px;"><?= htmlspecialchars($row['notes']) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <i class="bi bi-person-badge me-1 text-primary"></i>
                                    <?= htmlspecialchars($row['advisor_name'] ?? 'Faculty Advisor') ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $st = $row['status'] ?? 'Completed';
                                    $stBadge = ($st === 'Completed') ? 'bg-success-subtle text-success border border-success' : (($st === 'Follow-up Required') ? 'bg-warning-subtle text-dark border border-warning' : 'bg-light text-secondary border');
                                    ?>
                                    <span class="badge <?= $stBadge ?>"><?= htmlspecialchars($st) ?></span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($row['student_id'] ?? '') ?>" class="btn btn-sm btn-outline-primary" title="View Profile">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-journal-x fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No advising session logs recorded yet</p>
                                <small>Click "Log Advising Session" above to add consultation records.</small>
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

<!-- Modal: New Advising Session -->
<div class="modal fade" id="newAdvisingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header marsu-maroon-bg text-white">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-journal-plus me-1"></i> Log Academic Advising Session
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/create') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="type" value="advising">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STUDENT ID / NUMBER</label>
                            <input type="text" name="student_id" class="form-control form-control-sm" placeholder="e.g. 23-1001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">CONSULTATION DATE</label>
                            <input type="date" name="advising_date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">MAIN ADVISING TOPIC</label>
                        <input type="text" name="topic" class="form-control form-control-sm" placeholder="e.g. Midterm Grade Recovery Plan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">FACULTY / ADVISOR NOTES</label>
                        <textarea name="notes" class="form-control form-control-sm" rows="3" placeholder="Summary of discussion points, student concerns, and observation..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">RECOMMENDATIONS & ACTION PLAN</label>
                        <textarea name="recommendations" class="form-control form-control-sm" rows="2" placeholder="e.g. Endorse to peer tutoring for IT211, mandatory weekly study check-in"></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">STATUS</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="Completed">Completed</option>
                                <option value="Follow-up Required">Follow-up Required</option>
                                <option value="Scheduled">Scheduled</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">FOLLOW-UP DATE (OPTIONAL)</label>
                            <input type="date" name="follow_up_date" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm marsu-maroon-bg text-white px-4 fw-semibold">Save Session Log</button>
                </div>
            </form>
        </div>
    </div>
</div>

