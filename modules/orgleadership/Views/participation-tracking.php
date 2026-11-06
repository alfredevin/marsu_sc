<?php
/**
 * Participation Tracking View
 * Module: orgleadership
 *
 * Variables passed by controller:
 *   $title, $moduleName, $slug, $user
 *   $participations (array) - id, calendar_id, student_id, participation_role, contribution_details, activity_title, organization_name, first_name, last_name
 *   $events (array) - id, activity_title, organization_name
 *   $calendarFilter (int)
 */

$totalParticipations = count($participations);
$uniqueStudents = count(array_unique(array_column($participations, 'student_id')));
?>

<div class="container-fluid py-3">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <i class="bi bi-people me-2 text-gold"></i><?= e($title) ?>
            </h1>
            <p class="text-muted small mb-0">Track and manage student participation across organization activities and events.</p>
        </div>
        <div class="d-flex gap-2">
            <?php if ($events): ?>
                <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createParticipationModal">
                    <i class="bi bi-plus-circle me-1"></i>Add Participation
                </button>
            <?php endif; ?>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Dashboard
            </a>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-marsu-burgundy bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-clipboard-check fs-4 text-marsu-burgundy"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Participations</div>
                        <div class="h4 fw-bold mb-0 text-marsu-burgundy"><?= (int) $totalParticipations ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-person-check fs-4 text-warning"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Unique Students</div>
                        <div class="h4 fw-bold mb-0"><?= (int) $uniqueStudents ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="card shadow-sm border-0 mb-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span><i class="bi bi-table me-2"></i>Participation Records</span>
            <div class="d-flex gap-2 flex-wrap">
                <input type="text" class="form-control form-control-sm" id="searchParticipations" placeholder="Search table…" style="max-width:200px;">
                <form method="get" action="<?= e(url('orgleadership/participation-tracking')) ?>" class="d-flex gap-2">
                    <label class="visually-hidden" for="calendarFilterSelect">Filter by Event</label>
                    <select class="form-select form-select-sm" id="calendarFilterSelect" name="calendar_id" onchange="this.form.submit()">
                        <option value="">All Events / Activities</option>
                        <?php foreach ($events as $event): ?>
                            <option value="<?= (int) $event['id'] ?>" <?= $calendarFilter === (int) $event['id'] ? 'selected' : '' ?>>
                                <?= e($event['activity_title']) ?> — <?= e($event['organization_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-sm btn-outline-marsu" type="submit">Filter</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="participationsTable">
                <thead class="table-marsu">
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Activity</th>
                        <th>Organization</th>
                        <th>Role</th>
                        <th>Contribution</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$participations): ?>
                        <tr id="emptyRow">
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-people fs-2 d-block mb-2"></i>No participation records found.
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($participations as $index => $p): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><strong><?= e($p['last_name']) ?></strong>, <?= e($p['first_name']) ?></td>
                            <td><?= e($p['student_id']) ?></td>
                            <td><?= e($p['activity_title']) ?></td>
                            <td><span class="badge badge-gold"><?= e($p['organization_name']) ?></span></td>
                            <td><span class="badge bg-light text-dark border"><?= e($p['participation_role']) ?></span></td>
                            <td class="text-truncate" style="max-width:180px;" title="<?= e($p['contribution_details'] ?? '') ?>"><?= e($p['contribution_details'] ?? '—') ?></td>
                            <td class="text-end text-nowrap">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editParticipation<?= (int) $p['id'] ?>">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteParticipation<?= (int) $p['id'] ?>">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /container-fluid -->

<!-- ========================================= -->
<!-- Create Participation Modal                -->
<!-- ========================================= -->
<?php if ($events): ?>
<div class="modal fade" id="createParticipationModal" tabindex="-1" aria-labelledby="createParticipationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h2 class="modal-title h5" id="createParticipationModalLabel">
                    <i class="bi bi-plus-circle me-2"></i>Add Participation
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= e(url('orgleadership/participations/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="create-calendar-id">Event / Activity <span class="text-danger">*</span></label>
                        <select class="form-select" id="create-calendar-id" name="calendar_id" required>
                            <option value="" disabled selected>Select an event…</option>
                            <?php foreach ($events as $event): ?>
                                <option value="<?= (int) $event['id'] ?>"><?= e($event['activity_title']) ?> — <?= e($event['organization_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="create-student-id">Student ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="create-student-id" name="student_id" maxlength="50" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="create-role">Participation Role <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="create-role" name="participation_role" maxlength="100" placeholder="e.g. Participant, Organizer, Facilitator" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="create-contribution">Contribution Details</label>
                        <textarea class="form-control" id="create-contribution" name="contribution_details" rows="3" maxlength="500" placeholder="Describe the student's contribution…"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save Participation</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ========================================= -->
<!-- Edit Participation Modals (per row)       -->
<!-- ========================================= -->
<?php foreach ($participations as $p): ?>
<div class="modal fade" id="editParticipation<?= (int) $p['id'] ?>" tabindex="-1" aria-labelledby="editParticipationLabel<?= (int) $p['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h2 class="modal-title h5" id="editParticipationLabel<?= (int) $p['id'] ?>">
                    <i class="bi bi-pencil-square me-2"></i>Edit Participation
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= e(url('orgleadership/participations/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="participation_id" value="<?= (int) $p['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="edit-calendar-id-<?= (int) $p['id'] ?>">Event / Activity <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit-calendar-id-<?= (int) $p['id'] ?>" name="calendar_id" required>
                            <?php foreach ($events as $event): ?>
                                <option value="<?= (int) $event['id'] ?>" <?= (int) $p['calendar_id'] === (int) $event['id'] ? 'selected' : '' ?>>
                                    <?= e($event['activity_title']) ?> — <?= e($event['organization_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit-student-id-<?= (int) $p['id'] ?>">Student ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit-student-id-<?= (int) $p['id'] ?>" name="student_id" maxlength="50" value="<?= e($p['student_id']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit-role-<?= (int) $p['id'] ?>">Participation Role <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit-role-<?= (int) $p['id'] ?>" name="participation_role" maxlength="100" value="<?= e($p['participation_role']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit-contribution-<?= (int) $p['id'] ?>">Contribution Details</label>
                        <textarea class="form-control" id="edit-contribution-<?= (int) $p['id'] ?>" name="contribution_details" rows="3" maxlength="500"><?= e($p['contribution_details'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Update Participation</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- ========================================= -->
<!-- Delete Confirmation Modals (per row)      -->
<!-- ========================================= -->
<?php foreach ($participations as $p): ?>
<div class="modal fade" id="deleteParticipation<?= (int) $p['id'] ?>" tabindex="-1" aria-labelledby="deleteParticipationLabel<?= (int) $p['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h2 class="modal-title h5" id="deleteParticipationLabel<?= (int) $p['id'] ?>">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= e(url('orgleadership/participations/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="participation_id" value="<?= (int) $p['id'] ?>">
                <div class="modal-body">
                    <p class="mb-0">Remove participation record for <strong><?= e($p['last_name']) ?>, <?= e($p['first_name']) ?></strong> in <em><?= e($p['activity_title']) ?></em>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- ========================================= -->
<!-- Client-side Table Search                  -->
<!-- ========================================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchParticipations');
    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        const rows = document.querySelectorAll('#participationsTable tbody tr');

        rows.forEach(function (row) {
            if (row.id === 'emptyRow') return;
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
});
</script>
