<?php
/**
 * Engagement Points and Credits View
 * Module: orgleadership
 *
 * Variables passed by controller:
 *   $title, $moduleName, $slug, $user
 *   $credits (array) - id, student_id, calendar_id, points, reason, awarded_at, first_name, last_name, activity_title
 *   $events  (array) - id, activity_title
 *   $searchQuery (string)
 */

$totalPoints    = 0;
$uniqueStudents = [];
foreach ($credits as $c) {
    $totalPoints += (float) $c['points'];
    $uniqueStudents[$c['student_id']] = true;
}
$totalRecords   = count($credits);
$uniqueCount    = count($uniqueStudents);
?>

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-star me-2"></i><?= e($title ?? 'Engagement Points and Credits') ?>
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= url('orgleadership') ?>" class="text-decoration-none text-marsu-burgundy">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Engagement Points</li>
            </ol>
        </nav>
    </div>
    <button class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createCreditModal">
        <i class="bi bi-plus-lg me-1"></i> Award Credit
    </button>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <!-- Total Credits Awarded -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:52px;height:52px;background:rgba(128,0,32,.1);">
                    <i class="bi bi-trophy-fill fs-4 text-marsu-burgundy"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Total Credits Awarded</div>
                    <div class="fs-4 fw-bold text-marsu-burgundy"><?= number_format($totalPoints, 2) ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Records -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:52px;height:52px;background:rgba(212,175,55,.15);">
                    <i class="bi bi-journal-text fs-4" style="color:#D4AF37;"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Total Records</div>
                    <div class="fs-4 fw-bold"><?= $totalRecords ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Unique Students -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:52px;height:52px;background:rgba(128,0,32,.1);">
                    <i class="bi bi-people-fill fs-4 text-marsu-burgundy"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Unique Students</div>
                    <div class="fs-4 fw-bold"><?= $uniqueCount ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="<?= url('orgleadership/credits') ?>" class="row g-2 align-items-end">
            <div class="col-md-8 col-lg-6">
                <label for="searchInput" class="form-label fw-semibold small mb-1">Search Student</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" name="q" class="form-control"
                           placeholder="Name or Student ID…"
                           value="<?= e($searchQuery ?? '') ?>">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-marsu"><i class="bi bi-funnel me-1"></i> Filter</button>
            </div>
            <?php if (!empty($searchQuery)): ?>
                <div class="col-auto">
                    <a href="<?= url('orgleadership/credits') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Clear
                    </a>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="mb-0 fw-semibold text-marsu-burgundy"><i class="bi bi-table me-1"></i> Credits Register</h6>
    </div>
    <div class="card-body p-0">
        <!-- Client-side table filter -->
        <div class="p-3 pb-0">
            <input type="text" id="tableFilterInput" class="form-control form-control-sm" placeholder="Quick filter rows…">
        </div>

        <div class="table-responsive">
            <table class="table table-marsu table-hover align-middle mb-0" id="creditsTable">
                <thead>
                    <tr>
                        <th class="ps-3" style="width:50px;">#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Activity</th>
                        <th class="text-end">Points</th>
                        <th>Reason</th>
                        <th>Awarded At</th>
                        <th class="text-center" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($credits)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No credit records found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($credits as $idx => $credit): ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $idx + 1 ?></td>
                                <td class="fw-semibold"><?= e($credit['last_name']) ?>, <?= e($credit['first_name']) ?></td>
                                <td><span class="badge bg-light text-dark border"><?= e($credit['student_id']) ?></span></td>
                                <td><?= e($credit['activity_title'] ?? '—') ?></td>
                                <td class="text-end"><span class="badge badge-gold fs-6"><?= number_format((float)$credit['points'], 2) ?></span></td>
                                <td><?= e($credit['reason'] ?? '—') ?></td>
                                <td class="small text-muted"><?= e($credit['awarded_at'] ?? '—') ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary me-1 btn-edit-credit"
                                            title="Edit"
                                            data-id="<?= (int) $credit['id'] ?>"
                                            data-student-id="<?= e($credit['student_id']) ?>"
                                            data-calendar-id="<?= e($credit['calendar_id'] ?? '') ?>"
                                            data-points="<?= e($credit['points']) ?>"
                                            data-reason="<?= e($credit['reason'] ?? '') ?>"
                                            data-awarded-at="<?= e($credit['awarded_at'] ?? '') ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCreditModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete-credit"
                                            title="Delete"
                                            data-id="<?= (int) $credit['id'] ?>"
                                            data-student="<?= e($credit['last_name'] . ', ' . $credit['first_name']) ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteCreditModal">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ===================== CREATE CREDIT MODAL ===================== -->
<div class="modal fade" id="createCreditModal" tabindex="-1" aria-labelledby="createCreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/credits/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-marsu-burgundy" id="createCreditModalLabel">
                        <i class="bi bi-plus-circle me-1"></i> Award Credit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="createStudentId" class="form-label fw-semibold">Student ID <span class="text-danger">*</span></label>
                        <input type="text" id="createStudentId" name="student_id" class="form-control" required placeholder="e.g. 2024-00123">
                    </div>
                    <div class="mb-3">
                        <label for="createCalendarId" class="form-label fw-semibold">Activity / Event</label>
                        <select id="createCalendarId" name="calendar_id" class="form-select">
                            <option value="">— None —</option>
                            <?php foreach ($events as $evt): ?>
                                <option value="<?= (int) $evt['id'] ?>"><?= e($evt['activity_title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="createPoints" class="form-label fw-semibold">Points <span class="text-danger">*</span></label>
                        <input type="number" id="createPoints" name="points" class="form-control" step="0.01" min="0" required placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="createReason" class="form-label fw-semibold">Reason <span class="text-danger">*</span></label>
                        <input type="text" id="createReason" name="reason" class="form-control" required placeholder="Reason for awarding credit">
                    </div>
                    <div class="mb-3">
                        <label for="createAwardedAt" class="form-label fw-semibold">Awarded At <span class="text-danger">*</span></label>
                        <input type="datetime-local" id="createAwardedAt" name="awarded_at" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-check-lg me-1"></i> Save Credit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== EDIT CREDIT MODAL ===================== -->
<div class="modal fade" id="editCreditModal" tabindex="-1" aria-labelledby="editCreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/credits/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" id="editCreditId" name="credit_id">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-marsu-burgundy" id="editCreditModalLabel">
                        <i class="bi bi-pencil-square me-1"></i> Edit Credit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editStudentId" class="form-label fw-semibold">Student ID <span class="text-danger">*</span></label>
                        <input type="text" id="editStudentId" name="student_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCalendarId" class="form-label fw-semibold">Activity / Event</label>
                        <select id="editCalendarId" name="calendar_id" class="form-select">
                            <option value="">— None —</option>
                            <?php foreach ($events as $evt): ?>
                                <option value="<?= (int) $evt['id'] ?>"><?= e($evt['activity_title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editPoints" class="form-label fw-semibold">Points <span class="text-danger">*</span></label>
                        <input type="number" id="editPoints" name="points" class="form-control" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="editReason" class="form-label fw-semibold">Reason <span class="text-danger">*</span></label>
                        <input type="text" id="editReason" name="reason" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAwardedAt" class="form-label fw-semibold">Awarded At <span class="text-danger">*</span></label>
                        <input type="datetime-local" id="editAwardedAt" name="awarded_at" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-check-lg me-1"></i> Update Credit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== DELETE CONFIRMATION MODAL ===================== -->
<div class="modal fade" id="deleteCreditModal" tabindex="-1" aria-labelledby="deleteCreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/credits/delete') ?>">
                <?= csrf_field() ?>
                <input type="hidden" id="deleteCreditId" name="credit_id">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger" id="deleteCreditModalLabel">
                        <i class="bi bi-exclamation-triangle me-1"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete the credit record for <strong id="deleteStudentName"></strong>?</p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== VANILLA JS ===================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Client-side table quick filter ----
    const filterInput = document.getElementById('tableFilterInput');
    if (filterInput) {
        filterInput.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            const rows = document.querySelectorAll('#creditsTable tbody tr');
            rows.forEach(function (row) {
                if (row.querySelector('td[colspan]')) return; // skip empty-state row
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }

    // ---- Populate Edit Modal ----
    document.querySelectorAll('.btn-edit-credit').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editCreditId').value   = this.dataset.id;
            document.getElementById('editStudentId').value   = this.dataset.studentId;
            document.getElementById('editPoints').value      = this.dataset.points;
            document.getElementById('editReason').value      = this.dataset.reason;

            // Format awarded_at for datetime-local input (strip seconds / timezone if present)
            let awardedAt = this.dataset.awardedAt || '';
            if (awardedAt.length > 16) {
                awardedAt = awardedAt.substring(0, 16);
            }
            document.getElementById('editAwardedAt').value = awardedAt;

            // Set activity select
            const calendarSelect = document.getElementById('editCalendarId');
            const calVal = this.dataset.calendarId || '';
            calendarSelect.value = calVal;
        });
    });

    // ---- Populate Delete Modal ----
    document.querySelectorAll('.btn-delete-credit').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('deleteCreditId').value      = this.dataset.id;
            document.getElementById('deleteStudentName').textContent = this.dataset.student;
        });
    });

    // ---- Default "Awarded At" in create modal to current datetime ----
    const createModal = document.getElementById('createCreditModal');
    if (createModal) {
        createModal.addEventListener('show.bs.modal', function () {
            const now = new Date();
            const pad = function (n) { return String(n).padStart(2, '0'); };
            const local = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate())
                        + 'T' + pad(now.getHours()) + ':' + pad(now.getMinutes());
            document.getElementById('createAwardedAt').value = local;
        });
    }
});
</script>
