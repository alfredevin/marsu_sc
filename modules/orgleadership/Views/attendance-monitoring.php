<?php
/**
 * Attendance Monitoring View
 * Module: orgleadership
 *
 * Variables passed by controller:
 *   $title, $moduleName, $slug, $user
 *   $attendances, $events, $calendarFilter, $attendanceStatuses
 */

// KPI calculations
$totalRecords = count($attendances);
$presentCount = 0;
$absentCount  = 0;
foreach ($attendances as $a) {
    if ($a['attendance_status'] === 'Present') $presentCount++;
    if ($a['attendance_status'] === 'Absent')  $absentCount++;
}

// Status badge map
$badgeMap = [
    'Present' => 'bg-success',
    'Late'    => 'bg-warning text-dark',
    'Excused' => 'bg-info',
    'Absent'  => 'bg-danger',
];
?>

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
    <div>
        <h1 class="h3 mb-1 text-marsu-burgundy fw-bold">
            <i class="bi bi-person-check me-2"></i><?= e($title ?? 'Attendance Monitoring') ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= url('orgleadership/dashboard') ?>" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Monitoring</li>
            </ol>
        </nav>
    </div>
    <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createAttendanceModal">
        <i class="bi bi-plus-lg me-1"></i>Record Attendance
    </button>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <!-- Total Records -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-marsu-burgundy bg-opacity-10">
                    <i class="bi bi-list-check fs-3 text-marsu-burgundy"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Total Records</div>
                    <div class="fs-4 fw-bold"><?= $totalRecords ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Present Count -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background-color: rgba(25,135,84,.12);">
                    <i class="bi bi-check-circle fs-3 text-success"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Present</div>
                    <div class="fs-4 fw-bold text-success"><?= $presentCount ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Absent Count -->
    <div class="col-sm-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background-color: rgba(220,53,69,.12);">
                    <i class="bi bi-x-circle fs-3 text-danger"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-semibold">Absent</div>
                    <div class="fs-4 fw-bold text-danger"><?= $absentCount ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <!-- Event / Activity Filter -->
            <div class="col-md-5 col-lg-4">
                <label for="filterEvent" class="form-label fw-semibold small text-uppercase">Filter by Event / Activity</label>
                <select id="filterEvent" class="form-select" onchange="applyEventFilter(this.value)">
                    <option value="">All Events</option>
                    <?php foreach ($events as $ev): ?>
                        <option value="<?= (int) $ev['id'] ?>" <?= ((int)($calendarFilter ?? 0) === (int)$ev['id']) ? 'selected' : '' ?>>
                            <?= e($ev['activity_title']) ?> — <?= e($ev['organization_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Table Search -->
            <div class="col-md-5 col-lg-4">
                <label for="tableSearch" class="form-label fw-semibold small text-uppercase">Search</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="tableSearch" class="form-control" placeholder="Search records…">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendance Data Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-marsu table-hover align-middle mb-0" id="attendanceTable">
                <thead>
                    <tr>
                        <th class="ps-3" style="width:50px;">#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Activity</th>
                        <th>Organization</th>
                        <th>Status</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th class="text-center" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($attendances)): ?>
                        <tr id="emptyRow">
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No attendance records found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($attendances as $i => $att):
                            $badgeClass = $badgeMap[$att['attendance_status']] ?? 'bg-secondary';
                        ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td class="fw-semibold"><?= e($att['last_name']) ?>, <?= e($att['first_name']) ?></td>
                                <td><?= e($att['student_id']) ?></td>
                                <td><?= e($att['activity_title']) ?></td>
                                <td><span class="badge badge-gold"><?= e($att['organization_name']) ?></span></td>
                                <td><span class="badge <?= $badgeClass ?>"><?= e($att['attendance_status']) ?></span></td>
                                <td><?= $att['time_in'] ? e(date('h:i A', strtotime($att['time_in']))) : '—' ?></td>
                                <td><?= $att['time_out'] ? e(date('h:i A', strtotime($att['time_out']))) : '—' ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1"
                                        title="Edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editAttendanceModal"
                                        data-att-id="<?= (int) $att['id'] ?>"
                                        data-att-calendar="<?= (int) $att['calendar_id'] ?>"
                                        data-att-student="<?= e($att['student_id']) ?>"
                                        data-att-status="<?= e($att['attendance_status']) ?>"
                                        data-att-timein="<?= $att['time_in'] ? e(date('H:i', strtotime($att['time_in']))) : '' ?>"
                                        data-att-timeout="<?= $att['time_out'] ? e(date('H:i', strtotime($att['time_out']))) : '' ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        title="Delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteAttendanceModal"
                                        data-att-id="<?= (int) $att['id'] ?>"
                                        data-att-name="<?= e($att['last_name'] . ', ' . $att['first_name']) ?>">
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

<!-- ======================== CREATE MODAL ======================== -->
<div class="modal fade" id="createAttendanceModal" tabindex="-1" aria-labelledby="createAttendanceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/attendances/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-marsu-burgundy" id="createAttendanceLabel">
                        <i class="bi bi-plus-circle me-2"></i>Record Attendance
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Event / Activity -->
                    <div class="mb-3">
                        <label for="createCalendarId" class="form-label fw-semibold">Event / Activity <span class="text-danger">*</span></label>
                        <select id="createCalendarId" name="calendar_id" class="form-select" required>
                            <option value="" disabled selected>Select an event…</option>
                            <?php foreach ($events as $ev): ?>
                                <option value="<?= (int) $ev['id'] ?>">
                                    <?= e($ev['activity_title']) ?> — <?= e($ev['organization_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Student ID -->
                    <div class="mb-3">
                        <label for="createStudentId" class="form-label fw-semibold">Student ID <span class="text-danger">*</span></label>
                        <input type="text" id="createStudentId" name="student_id" class="form-control" placeholder="e.g. 2024-00123" required>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="createStatus" class="form-label fw-semibold">Attendance Status <span class="text-danger">*</span></label>
                        <select id="createStatus" name="attendance_status" class="form-select" required>
                            <option value="" disabled selected>Select status…</option>
                            <?php foreach ($attendanceStatuses as $status): ?>
                                <option value="<?= e($status) ?>"><?= e($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Time In / Time Out -->
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="createTimeIn" class="form-label fw-semibold">Time In</label>
                            <input type="time" id="createTimeIn" name="time_in" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="createTimeOut" class="form-label fw-semibold">Time Out</label>
                            <input type="time" id="createTimeOut" name="time_out" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-check-lg me-1"></i>Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================== EDIT MODAL ======================== -->
<div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-labelledby="editAttendanceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/attendances/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="attendance_id" id="editAttendanceId">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-marsu-burgundy" id="editAttendanceLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Attendance
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Event / Activity -->
                    <div class="mb-3">
                        <label for="editCalendarId" class="form-label fw-semibold">Event / Activity <span class="text-danger">*</span></label>
                        <select id="editCalendarId" name="calendar_id" class="form-select" required>
                            <option value="" disabled>Select an event…</option>
                            <?php foreach ($events as $ev): ?>
                                <option value="<?= (int) $ev['id'] ?>">
                                    <?= e($ev['activity_title']) ?> — <?= e($ev['organization_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Student ID -->
                    <div class="mb-3">
                        <label for="editStudentId" class="form-label fw-semibold">Student ID <span class="text-danger">*</span></label>
                        <input type="text" id="editStudentId" name="student_id" class="form-control" required>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="editStatus" class="form-label fw-semibold">Attendance Status <span class="text-danger">*</span></label>
                        <select id="editStatus" name="attendance_status" class="form-select" required>
                            <?php foreach ($attendanceStatuses as $status): ?>
                                <option value="<?= e($status) ?>"><?= e($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Time In / Time Out -->
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="editTimeIn" class="form-label fw-semibold">Time In</label>
                            <input type="time" id="editTimeIn" name="time_in" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="editTimeOut" class="form-label fw-semibold">Time Out</label>
                            <input type="time" id="editTimeOut" name="time_out" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-check-lg me-1"></i>Update Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================== DELETE MODAL ======================== -->
<div class="modal fade" id="deleteAttendanceModal" tabindex="-1" aria-labelledby="deleteAttendanceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/attendances/delete') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="attendance_id" id="deleteAttendanceId">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-danger" id="deleteAttendanceLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>Delete Record
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-1">Are you sure you want to delete the attendance record for:</p>
                    <p class="fw-bold" id="deleteAttendanceName"></p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================== SCRIPTS ======================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Event Filter (server-side reload) ----
    window.applyEventFilter = function (calendarId) {
        const base = '<?= url('orgleadership/attendance-monitoring') ?>';
        if (calendarId) {
            window.location.href = base + '?calendar_id=' + encodeURIComponent(calendarId);
        } else {
            window.location.href = base;
        }
    };

    // ---- Table Search ----
    const searchInput = document.getElementById('tableSearch');
    const tableBody   = document.querySelector('#attendanceTable tbody');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll('tr:not(#emptyRow)');

            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }

    // ---- Populate Edit Modal ----
    const editModal = document.getElementById('editAttendanceModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            if (!btn) return;

            document.getElementById('editAttendanceId').value  = btn.getAttribute('data-att-id');
            document.getElementById('editCalendarId').value    = btn.getAttribute('data-att-calendar');
            document.getElementById('editStudentId').value     = btn.getAttribute('data-att-student');
            document.getElementById('editStatus').value        = btn.getAttribute('data-att-status');
            document.getElementById('editTimeIn').value        = btn.getAttribute('data-att-timein') || '';
            document.getElementById('editTimeOut').value       = btn.getAttribute('data-att-timeout') || '';
        });
    }

    // ---- Populate Delete Modal ----
    const deleteModal = document.getElementById('deleteAttendanceModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            if (!btn) return;

            document.getElementById('deleteAttendanceId').value   = btn.getAttribute('data-att-id');
            document.getElementById('deleteAttendanceName').textContent = btn.getAttribute('data-att-name');
        });
    }

});
</script>
