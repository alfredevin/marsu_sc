<?php
/**
 * Activity Calendar View
 * Module: Organization Leadership (orgleadership)
 * Lists scheduled activities with filtering, KPI cards, and CRUD modals.
 */

// --- KPI Calculations ---
$totalScheduled = 0;
$thisMonthCount = 0;
$completedCount = 0;
$currentYearMonth = date('Y-m');

foreach ($events as $ev) {
    $totalScheduled++;
    if (substr($ev['start_datetime'], 0, 7) === $currentYearMonth) {
        $thisMonthCount++;
    }
    if (strtolower($ev['status']) === 'completed') {
        $completedCount++;
    }
}

// Status badge map
$statusBadge = [
    'Scheduled'  => 'bg-primary',
    'Ongoing'    => 'bg-info',
    'Completed'  => 'bg-success',
    'Cancelled'  => 'bg-secondary',
];
?>

<!-- Page Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1 text-marsu-burgundy fw-bold">
            <i class="bi bi-calendar-event me-2"></i><?= e($title ?? 'Activity Calendar') ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= url('orgleadership') ?>">Organization Leadership</a></li>
                <li class="breadcrumb-item active" aria-current="page">Activity Calendar</li>
            </ol>
        </nav>
    </div>
    <button class="btn btn-marsu mt-2 mt-md-0" data-bs-toggle="modal" data-bs-target="#createActivityModal">
        <i class="bi bi-plus-lg me-1"></i>New Activity
    </button>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <!-- Total Scheduled -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 me-3" style="background:rgba(128,0,32,.1);">
                    <i class="bi bi-calendar-check fs-3 text-marsu-burgundy"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Total Scheduled</div>
                    <div class="fs-4 fw-bold"><?= $totalScheduled ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- This Month -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 me-3" style="background:rgba(212,175,55,.15);">
                    <i class="bi bi-calendar-month fs-3" style="color:#D4AF37;"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">This Month</div>
                    <div class="fs-4 fw-bold"><?= $thisMonthCount ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Completed -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 me-3" style="background:rgba(25,135,84,.1);">
                    <i class="bi bi-check-circle fs-3 text-success"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Completed</div>
                    <div class="fs-4 fw-bold"><?= $completedCount ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="<?= url('orgleadership/calendar') ?>" class="row g-2 align-items-end">
            <!-- Organization Filter -->
            <div class="col-md-4">
                <label for="filterOrganization" class="form-label small fw-semibold mb-1">Organization</label>
                <select id="filterOrganization" name="organization_id" class="form-select form-select-sm">
                    <option value="">All Organizations</option>
                    <?php foreach ($organizations as $org): ?>
                        <option value="<?= (int)$org['id'] ?>" <?= ((int)($orgFilter ?? 0) === (int)$org['id']) ? 'selected' : '' ?>>
                            <?= e($org['name']) ?> (<?= e($org['acronym']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Month Filter -->
            <div class="col-md-3">
                <label for="filterMonth" class="form-label small fw-semibold mb-1">Month</label>
                <input type="month" id="filterMonth" name="month" class="form-control form-control-sm"
                       value="<?= e($monthFilter ?? '') ?>">
            </div>
            <!-- Buttons -->
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-marsu btn-sm">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                <a href="<?= url('orgleadership/calendar') ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-x-lg me-1"></i>Reset
                </a>
            </div>
            <!-- Table Search -->
            <div class="col-md-2 ms-md-auto">
                <label for="tableSearch" class="form-label small fw-semibold mb-1">Search</label>
                <input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search table…">
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-marsu table-hover align-middle mb-0" id="calendarTable">
                <thead>
                    <tr>
                        <th class="ps-3" style="width:50px;">#</th>
                        <th>Activity Title</th>
                        <th>Organization</th>
                        <th>Venue</th>
                        <th>Start Date/Time</th>
                        <th>End Date/Time</th>
                        <th>Status</th>
                        <th class="text-center" style="width:100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($events)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                No activities found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $rowNum = 0; foreach ($events as $ev): $rowNum++; ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $rowNum ?></td>
                                <td class="fw-semibold"><?= e($ev['activity_title']) ?></td>
                                <td>
                                    <span class="badge badge-gold"><?= e($ev['organization_acronym']) ?></span>
                                    <span class="d-none"><?= e($ev['organization_name']) ?></span>
                                </td>
                                <td><?= e($ev['venue_name'] ?? '—') ?></td>
                                <td><?= date('M d, Y h:i A', strtotime($ev['start_datetime'])) ?></td>
                                <td><?= date('M d, Y h:i A', strtotime($ev['end_datetime'])) ?></td>
                                <td>
                                    <?php $badge = $statusBadge[$ev['status']] ?? 'bg-secondary'; ?>
                                    <span class="badge <?= $badge ?>"><?= e($ev['status']) ?></span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary me-1 btn-edit-activity"
                                        data-id="<?= (int)$ev['id'] ?>"
                                        data-organization_id="<?= (int)$ev['organization_id'] ?>"
                                        data-proposal_id="<?= (int)($ev['proposal_id'] ?? 0) ?>"
                                        data-venue_id="<?= (int)($ev['venue_id'] ?? 0) ?>"
                                        data-activity_title="<?= e($ev['activity_title']) ?>"
                                        data-start_datetime="<?= e(date('Y-m-d\TH:i', strtotime($ev['start_datetime']))) ?>"
                                        data-end_datetime="<?= e(date('Y-m-d\TH:i', strtotime($ev['end_datetime']))) ?>"
                                        data-status="<?= e($ev['status']) ?>"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete-activity"
                                        data-id="<?= (int)$ev['id'] ?>"
                                        data-title="<?= e($ev['activity_title']) ?>"
                                        title="Delete">
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

<!-- ===================== CREATE ACTIVITY MODAL ===================== -->
<div class="modal fade" id="createActivityModal" tabindex="-1" aria-labelledby="createActivityLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/calendar/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-header bg-marsu-burgundy text-white">
                    <h5 class="modal-title" id="createActivityLabel">
                        <i class="bi bi-plus-circle me-2"></i>New Activity
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Organization -->
                        <div class="col-md-6">
                            <label for="createOrgId" class="form-label">Organization <span class="text-danger">*</span></label>
                            <select id="createOrgId" name="organization_id" class="form-select" required>
                                <option value="">— Select Organization —</option>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?= (int)$org['id'] ?>"><?= e($org['name']) ?> (<?= e($org['acronym']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Proposal (optional) -->
                        <div class="col-md-6">
                            <label for="createProposalId" class="form-label">Linked Proposal</label>
                            <select id="createProposalId" name="proposal_id" class="form-select">
                                <option value="">— None —</option>
                                <?php foreach ($proposals as $prop): ?>
                                    <option value="<?= (int)$prop['id'] ?>"><?= e($prop['activity_title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Venue (optional) -->
                        <div class="col-md-6">
                            <label for="createVenueId" class="form-label">Venue</label>
                            <select id="createVenueId" name="venue_id" class="form-select">
                                <option value="">— None —</option>
                                <?php foreach ($venues as $v): ?>
                                    <option value="<?= (int)$v['id'] ?>"><?= e($v['venue_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Activity Title -->
                        <div class="col-md-6">
                            <label for="createTitle" class="form-label">Activity Title <span class="text-danger">*</span></label>
                            <input type="text" id="createTitle" name="activity_title" class="form-control" required maxlength="255" placeholder="Enter activity title">
                        </div>
                        <!-- Start Date/Time -->
                        <div class="col-md-6">
                            <label for="createStart" class="form-label">Start Date/Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="createStart" name="start_datetime" class="form-control" required>
                        </div>
                        <!-- End Date/Time -->
                        <div class="col-md-6">
                            <label for="createEnd" class="form-label">End Date/Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="createEnd" name="end_datetime" class="form-control" required>
                        </div>
                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="createStatus" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="createStatus" name="status" class="form-select" required>
                                <option value="Scheduled" selected>Scheduled</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i>Save Activity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== EDIT ACTIVITY MODAL ===================== -->
<div class="modal fade" id="editActivityModal" tabindex="-1" aria-labelledby="editActivityLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/calendar/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="calendar_id" id="editCalendarId">
                <div class="modal-header bg-marsu-burgundy text-white">
                    <h5 class="modal-title" id="editActivityLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Activity
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Organization -->
                        <div class="col-md-6">
                            <label for="editOrgId" class="form-label">Organization <span class="text-danger">*</span></label>
                            <select id="editOrgId" name="organization_id" class="form-select" required>
                                <option value="">— Select Organization —</option>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?= (int)$org['id'] ?>"><?= e($org['name']) ?> (<?= e($org['acronym']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Proposal (optional) -->
                        <div class="col-md-6">
                            <label for="editProposalId" class="form-label">Linked Proposal</label>
                            <select id="editProposalId" name="proposal_id" class="form-select">
                                <option value="">— None —</option>
                                <?php foreach ($proposals as $prop): ?>
                                    <option value="<?= (int)$prop['id'] ?>"><?= e($prop['activity_title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Venue (optional) -->
                        <div class="col-md-6">
                            <label for="editVenueId" class="form-label">Venue</label>
                            <select id="editVenueId" name="venue_id" class="form-select">
                                <option value="">— None —</option>
                                <?php foreach ($venues as $v): ?>
                                    <option value="<?= (int)$v['id'] ?>"><?= e($v['venue_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Activity Title -->
                        <div class="col-md-6">
                            <label for="editTitle" class="form-label">Activity Title <span class="text-danger">*</span></label>
                            <input type="text" id="editTitle" name="activity_title" class="form-control" required maxlength="255">
                        </div>
                        <!-- Start Date/Time -->
                        <div class="col-md-6">
                            <label for="editStart" class="form-label">Start Date/Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="editStart" name="start_datetime" class="form-control" required>
                        </div>
                        <!-- End Date/Time -->
                        <div class="col-md-6">
                            <label for="editEnd" class="form-label">End Date/Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="editEnd" name="end_datetime" class="form-control" required>
                        </div>
                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="editStatus" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="editStatus" name="status" class="form-select" required>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i>Update Activity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== DELETE CONFIRM MODAL ===================== -->
<div class="modal fade" id="deleteActivityModal" tabindex="-1" aria-labelledby="deleteActivityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/calendar/delete') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="calendar_id" id="deleteCalendarId">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteActivityLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the activity <strong id="deleteActivityName"></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== JAVASCRIPT ===================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Table Search Filter ----
    const searchInput = document.getElementById('tableSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#calendarTable tbody tr');
            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    // ---- Edit Modal Population ----
    document.querySelectorAll('.btn-edit-activity').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editCalendarId').value   = this.dataset.id;
            document.getElementById('editOrgId').value        = this.dataset.organization_id;
            document.getElementById('editProposalId').value   = this.dataset.proposal_id || '';
            document.getElementById('editVenueId').value      = this.dataset.venue_id || '';
            document.getElementById('editTitle').value        = this.dataset.activity_title;
            document.getElementById('editStart').value        = this.dataset.start_datetime;
            document.getElementById('editEnd').value          = this.dataset.end_datetime;
            document.getElementById('editStatus').value       = this.dataset.status;

            const editModal = new bootstrap.Modal(document.getElementById('editActivityModal'));
            editModal.show();
        });
    });

    // ---- Delete Modal Population ----
    document.querySelectorAll('.btn-delete-activity').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('deleteCalendarId').value   = this.dataset.id;
            document.getElementById('deleteActivityName').textContent = this.dataset.title;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteActivityModal'));
            deleteModal.show();
        });
    });

    // ---- End-date auto-fill: default end = start + 1 hour ----
    const createStart = document.getElementById('createStart');
    const createEnd   = document.getElementById('createEnd');
    if (createStart && createEnd) {
        createStart.addEventListener('change', function () {
            if (!createEnd.value && this.value) {
                const dt = new Date(this.value);
                dt.setHours(dt.getHours() + 1);
                const pad = function (n) { return String(n).padStart(2, '0'); };
                createEnd.value = dt.getFullYear() + '-' + pad(dt.getMonth() + 1) + '-' + pad(dt.getDate()) +
                    'T' + pad(dt.getHours()) + ':' + pad(dt.getMinutes());
            }
        });
    }
});
</script>
