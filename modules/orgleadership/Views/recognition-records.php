<?php
/**
 * Recognition Records – Student Organization & Leadership Module
 *
 * Variables supplied by the controller:
 *   $title        (string)  Page title
 *   $moduleName   (string)  Module display name
 *   $slug         (string)  Module slug
 *   $user         (array)   Authenticated user
 *   $recognitions (array)   Each row: id, student_id, recognition_title, recognition_date, description, first_name, last_name
 *   $searchQuery  (string)  Current search filter value
 */

// ---------- KPI helpers ----------
$totalRecognitions = count($recognitions);
$currentYear       = date('Y');
$thisYearCount     = 0;
foreach ($recognitions as $rec) {
    if (isset($rec['recognition_date']) && str_starts_with($rec['recognition_date'], $currentYear)) {
        $thisYearCount++;
    }
}
?>
<div class="container-fluid py-3">

    <!-- ── Page header ─────────────────────────────────────────────── -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-trophy me-2 text-gold"></i>Recognition Records
            </h1>
            <p class="text-muted small mb-0">Track and manage student recognitions, awards, and commendations.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createRecognitionModal">
                <i class="bi bi-plus-circle me-1"></i>Add Recognition
            </button>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Dashboard
            </a>
        </div>
    </div>

    <!-- ── KPI cards ───────────────────────────────────────────────── -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#800020;color:#fff;font-size:1.25rem;">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Total Recognitions</p>
                        <h4 class="mb-0 text-marsu-burgundy"><?= (int)$totalRecognitions ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#D4AF37;color:#fff;font-size:1.25rem;">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">This Year (<?= e($currentYear) ?>)</p>
                        <h4 class="mb-0 text-marsu-burgundy"><?= (int)$thisYearCount ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Data card ───────────────────────────────────────────────── -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span><i class="bi bi-table me-2"></i>Recognition directory</span>

            <!-- Search bar -->
            <form method="get" action="<?= e(url('orgleadership/recognition-records')) ?>" class="d-flex gap-2">
                <label class="visually-hidden" for="searchInput">Search students</label>
                <input
                    type="search"
                    class="form-control form-control-sm"
                    id="searchInput"
                    name="q"
                    placeholder="Search by student name or ID…"
                    value="<?= e($searchQuery ?? '') ?>"
                    style="min-width:220px;"
                >
                <button class="btn btn-sm btn-outline-marsu" type="submit"><i class="bi bi-search"></i></button>
                <?php if (!empty($searchQuery)): ?>
                    <a href="<?= e(url('orgleadership/recognition-records')) ?>" class="btn btn-sm btn-outline-secondary" title="Clear search"><i class="bi bi-x-lg"></i></a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="recognitionTable">
                <thead class="table-marsu">
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Recognition Title</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$recognitions): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-trophy fs-2 d-block mb-2"></i>
                            No recognition records found<?= !empty($searchQuery) ? ' matching "<strong>' . e($searchQuery) . '</strong>"' : '' ?>.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($recognitions as $index => $rec): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= e($rec['last_name'] ?? '') ?></strong>, <?= e($rec['first_name'] ?? '') ?></td>
                        <td><?= e($rec['student_id'] ?? '-') ?></td>
                        <td><span class="badge badge-gold"><?= e($rec['recognition_title'] ?? '') ?></span></td>
                        <td><?= e($rec['recognition_date'] ?? '-') ?></td>
                        <td class="text-truncate" style="max-width:220px;" title="<?= e($rec['description'] ?? '') ?>"><?= e($rec['description'] ?? '') ?></td>
                        <td class="text-end text-nowrap">
                            <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editRecognition<?= (int)$rec['id'] ?>">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteRecognition<?= (int)$rec['id'] ?>">
                                <i class="bi bi-trash me-1"></i>Delete
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

<!-- ═══════════════════════════════════════════════════════════════════
     CREATE MODAL
     ═══════════════════════════════════════════════════════════════════ -->
<div class="modal fade" id="createRecognitionModal" tabindex="-1" aria-labelledby="createRecognitionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h2 class="modal-title h5" id="createRecognitionModalLabel">
                    <i class="bi bi-trophy me-2"></i>Add Recognition Record
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= e(url('orgleadership/recognitions/store')) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="create-student-id">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create-student-id" name="student_id" maxlength="50" required placeholder="e.g. 2024-00123">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create-recognition-title">Recognition Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="create-recognition-title" name="recognition_title" maxlength="191" required placeholder="e.g. Dean's Lister">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create-recognition-date">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="create-recognition-date" name="recognition_date" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="create-description">Description</label>
                            <textarea class="form-control" id="create-description" name="description" rows="3" maxlength="500" placeholder="Brief description of the recognition…"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save Recognition</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════
     EDIT + DELETE MODALS (per row)
     ═══════════════════════════════════════════════════════════════════ -->
<?php foreach ($recognitions as $rec): ?>

<!-- Edit modal -->
<div class="modal fade" id="editRecognition<?= (int)$rec['id'] ?>" tabindex="-1" aria-labelledby="editRecognitionLabel<?= (int)$rec['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h2 class="modal-title h5" id="editRecognitionLabel<?= (int)$rec['id'] ?>">
                    <i class="bi bi-pencil-square me-2"></i>Edit Recognition
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= e(url('orgleadership/recognitions/update')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="recognition_id" value="<?= (int)$rec['id'] ?>">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="edit-student-id-<?= (int)$rec['id'] ?>">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-student-id-<?= (int)$rec['id'] ?>" name="student_id" value="<?= e($rec['student_id'] ?? '') ?>" maxlength="50" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit-recognition-title-<?= (int)$rec['id'] ?>">Recognition Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-recognition-title-<?= (int)$rec['id'] ?>" name="recognition_title" value="<?= e($rec['recognition_title'] ?? '') ?>" maxlength="191" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit-recognition-date-<?= (int)$rec['id'] ?>">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="edit-recognition-date-<?= (int)$rec['id'] ?>" name="recognition_date" value="<?= e($rec['recognition_date'] ?? '') ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="edit-description-<?= (int)$rec['id'] ?>">Description</label>
                            <textarea class="form-control" id="edit-description-<?= (int)$rec['id'] ?>" name="description" rows="3" maxlength="500"><?= e($rec['description'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Update Recognition</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete confirmation modal -->
<div class="modal fade" id="deleteRecognition<?= (int)$rec['id'] ?>" tabindex="-1" aria-labelledby="deleteRecognitionLabel<?= (int)$rec['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h2 class="modal-title h5" id="deleteRecognitionLabel<?= (int)$rec['id'] ?>">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Deletion
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= e(url('orgleadership/recognitions/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="recognition_id" value="<?= (int)$rec['id'] ?>">
                <div class="modal-body">
                    <p>Are you sure you want to delete the recognition <strong>"<?= e($rec['recognition_title'] ?? '') ?>"</strong> for student <strong><?= e(($rec['last_name'] ?? '') . ', ' . ($rec['first_name'] ?? '')) ?></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
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

<!-- ── Client-side table filter (instant search) ───────────────────── -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        const rows  = document.querySelectorAll('#recognitionTable tbody tr');

        rows.forEach(function (row) {
            if (row.querySelector('td[colspan]')) return; // skip empty-state row
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });
});
</script>
