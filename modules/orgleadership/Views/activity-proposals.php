<?php
/**
 * Activity Proposal Submission View
 * Module: Organization Leadership (orgleadership)
 *
 * Variables passed by controller:
 *  $title, $moduleName, $slug, $user,
 *  $proposals, $organizations, $students,
 *  $proposalStatuses, $orgFilter, $statusFilter
 */

$approvedCount = 0;
$pendingCount  = 0;
foreach ($proposals as $p) {
    if ($p['proposal_status'] === 'Approved') {
        $approvedCount++;
    }
    if (in_array($p['proposal_status'], ['Submitted', 'Under Review'], true)) {
        $pendingCount++;
    }
}
$totalCount = count($proposals);
?>

<!-- Page Header -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-marsu-burgundy">
            <i class="bi bi-file-earmark-text me-2"></i><?= e($title ?? 'Activity Proposal Submission') ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= url('orgleadership/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Activity Proposals</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2 mt-2 mt-md-0">
        <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createProposalModal">
            <i class="bi bi-plus-lg me-1"></i>New Proposal
        </button>
        <a href="<?= url('orgleadership/dashboard') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-speedometer2 me-1"></i>Dashboard
        </a>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <!-- Total Proposals -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-marsu-burgundy bg-opacity-10 p-3 me-3">
                    <i class="bi bi-file-earmark-text fs-4 text-marsu-burgundy"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase">Total Proposals</h6>
                    <h3 class="mb-0 fw-bold"><?= (int) $totalCount ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Approved -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                    <i class="bi bi-check-circle fs-4 text-success"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase">Approved</h6>
                    <h3 class="mb-0 fw-bold text-success"><?= (int) $approvedCount ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Review -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                    <i class="bi bi-hourglass-split fs-4 text-info"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase">Pending Review</h6>
                    <h3 class="mb-0 fw-bold text-info"><?= (int) $pendingCount ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form id="filterForm" method="GET" action="<?= url('orgleadership/proposals') ?>" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label for="filterOrg" class="form-label small fw-semibold mb-1">Organization</label>
                <select id="filterOrg" name="org" class="form-select form-select-sm">
                    <option value="">All Organizations</option>
                    <?php foreach ($organizations as $org): ?>
                        <option value="<?= (int) $org['id'] ?>" <?= ((int) $orgFilter === (int) $org['id']) ? 'selected' : '' ?>>
                            <?= e($org['acronym']) ?> — <?= e($org['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterStatus" class="form-label small fw-semibold mb-1">Status</label>
                <select id="filterStatus" name="status" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <?php foreach ($proposalStatuses as $st): ?>
                        <option value="<?= e($st) ?>" <?= ($statusFilter === $st) ? 'selected' : '' ?>>
                            <?= e($st) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="tableSearch" class="form-label small fw-semibold mb-1">Search</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search proposals…">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-marsu table-hover align-middle mb-0" id="proposalsTable">
                <thead>
                    <tr>
                        <th class="ps-3" style="width:50px">#</th>
                        <th>Activity Title</th>
                        <th>Organization</th>
                        <th>Proposed By</th>
                        <th>Proposed Date</th>
                        <th class="text-end">Budget</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width:120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($proposals)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No proposals found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($proposals as $i => $row): ?>
                            <?php
                                $badgeClass = match ($row['proposal_status']) {
                                    'Approved'          => 'bg-success',
                                    'Rejected'          => 'bg-danger',
                                    'Draft'             => 'bg-secondary',
                                    'Under Review'      => 'bg-info',
                                    'Submitted'         => 'bg-primary',
                                    'Revision Required' => 'bg-warning text-dark',
                                    default             => 'bg-secondary',
                                };
                            ?>
                            <tr>
                                <td class="ps-3"><?= $i + 1 ?></td>
                                <td class="fw-semibold"><?= e($row['activity_title']) ?></td>
                                <td>
                                    <span class="badge badge-gold"><?= e($row['organization_acronym']) ?></span>
                                    <span class="d-none d-lg-inline ms-1 small text-muted"><?= e($row['organization_name']) ?></span>
                                </td>
                                <td><?= e($row['last_name']) ?>, <?= e($row['first_name']) ?></td>
                                <td><?= e(date('M d, Y', strtotime($row['proposed_date']))) ?></td>
                                <td class="text-end">₱<?= e(number_format((float) $row['proposed_budget'], 2)) ?></td>
                                <td class="text-center">
                                    <span class="badge <?= $badgeClass ?>"><?= e($row['proposal_status']) ?></span>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary me-1"
                                            title="Edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editProposalModal<?= (int) $row['id'] ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-delete-proposal"
                                            title="Delete"
                                            data-id="<?= (int) $row['id'] ?>"
                                            data-title="<?= e($row['activity_title']) ?>">
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

<!-- ========================================== -->
<!-- Create Proposal Modal                      -->
<!-- ========================================== -->
<div class="modal fade" id="createProposalModal" tabindex="-1" aria-labelledby="createProposalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/proposals/store') ?>">
                <?= csrf_field() ?>
                <div class="modal-header bg-marsu-burgundy text-white">
                    <h5 class="modal-title" id="createProposalLabel">
                        <i class="bi bi-plus-circle me-2"></i>New Activity Proposal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Organization -->
                        <div class="col-md-6">
                            <label for="createOrgId" class="form-label">Organization <span class="text-danger">*</span></label>
                            <select id="createOrgId" name="organization_id" class="form-select" required>
                                <option value="" disabled selected>Select organization</option>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?= (int) $org['id'] ?>"><?= e($org['acronym']) ?> — <?= e($org['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Submitted By -->
                        <div class="col-md-6">
                            <label for="createStudentId" class="form-label">Submitted By (Student) <span class="text-danger">*</span></label>
                            <select id="createStudentId" name="submitted_by_student_id" class="form-select" required>
                                <option value="" disabled selected>Select student</option>
                                <?php foreach ($students as $stu): ?>
                                    <option value="<?= e($stu['student_number']) ?>">
                                        <?= e($stu['last_name']) ?>, <?= e($stu['first_name']) ?> (<?= e($stu['student_number']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Activity Title -->
                        <div class="col-12">
                            <label for="createTitle" class="form-label">Activity Title <span class="text-danger">*</span></label>
                            <input type="text" id="createTitle" name="activity_title" class="form-control" required maxlength="255" placeholder="e.g. Annual Leadership Summit 2026">
                        </div>
                        <!-- Objectives -->
                        <div class="col-12">
                            <label for="createObjectives" class="form-label">Objectives <span class="text-danger">*</span></label>
                            <textarea id="createObjectives" name="objectives" class="form-control" rows="3" required placeholder="Describe the objectives of this activity…"></textarea>
                        </div>
                        <!-- Proposed Date -->
                        <div class="col-md-6">
                            <label for="createDate" class="form-label">Proposed Date <span class="text-danger">*</span></label>
                            <input type="date" id="createDate" name="proposed_date" class="form-control" required>
                        </div>
                        <!-- Proposed Budget -->
                        <div class="col-md-6">
                            <label for="createBudget" class="form-label">Proposed Budget (₱) <span class="text-danger">*</span></label>
                            <input type="number" id="createBudget" name="proposed_budget" class="form-control" step="0.01" min="0" required placeholder="0.00">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i>Submit Proposal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- Edit Proposal Modals (per-row)             -->
<!-- ========================================== -->
<?php foreach ($proposals as $row): ?>
<div class="modal fade" id="editProposalModal<?= (int) $row['id'] ?>" tabindex="-1" aria-labelledby="editProposalLabel<?= (int) $row['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/proposals/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="proposal_id" value="<?= (int) $row['id'] ?>">
                <div class="modal-header bg-marsu-burgundy text-white">
                    <h5 class="modal-title" id="editProposalLabel<?= (int) $row['id'] ?>">
                        <i class="bi bi-pencil-square me-2"></i>Edit Proposal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Organization -->
                        <div class="col-md-6">
                            <label for="editOrgId<?= (int) $row['id'] ?>" class="form-label">Organization <span class="text-danger">*</span></label>
                            <select id="editOrgId<?= (int) $row['id'] ?>" name="organization_id" class="form-select" required>
                                <option value="" disabled>Select organization</option>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?= (int) $org['id'] ?>" <?= ((int) $row['organization_id'] === (int) $org['id']) ? 'selected' : '' ?>>
                                        <?= e($org['acronym']) ?> — <?= e($org['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Submitted By -->
                        <div class="col-md-6">
                            <label for="editStudentId<?= (int) $row['id'] ?>" class="form-label">Submitted By (Student) <span class="text-danger">*</span></label>
                            <select id="editStudentId<?= (int) $row['id'] ?>" name="submitted_by_student_id" class="form-select" required>
                                <option value="" disabled>Select student</option>
                                <?php foreach ($students as $stu): ?>
                                    <option value="<?= e($stu['student_number']) ?>" <?= ($row['submitted_by_student_id'] == $stu['student_number']) ? 'selected' : '' ?>>
                                        <?= e($stu['last_name']) ?>, <?= e($stu['first_name']) ?> (<?= e($stu['student_number']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Activity Title -->
                        <div class="col-12">
                            <label for="editTitle<?= (int) $row['id'] ?>" class="form-label">Activity Title <span class="text-danger">*</span></label>
                            <input type="text" id="editTitle<?= (int) $row['id'] ?>" name="activity_title" class="form-control" required maxlength="255" value="<?= e($row['activity_title']) ?>">
                        </div>
                        <!-- Objectives -->
                        <div class="col-12">
                            <label for="editObjectives<?= (int) $row['id'] ?>" class="form-label">Objectives <span class="text-danger">*</span></label>
                            <textarea id="editObjectives<?= (int) $row['id'] ?>" name="objectives" class="form-control" rows="3" required><?= e($row['objectives']) ?></textarea>
                        </div>
                        <!-- Proposed Date -->
                        <div class="col-md-6">
                            <label for="editDate<?= (int) $row['id'] ?>" class="form-label">Proposed Date <span class="text-danger">*</span></label>
                            <input type="date" id="editDate<?= (int) $row['id'] ?>" name="proposed_date" class="form-control" required value="<?= e($row['proposed_date']) ?>">
                        </div>
                        <!-- Proposed Budget -->
                        <div class="col-md-6">
                            <label for="editBudget<?= (int) $row['id'] ?>" class="form-label">Proposed Budget (₱) <span class="text-danger">*</span></label>
                            <input type="number" id="editBudget<?= (int) $row['id'] ?>" name="proposed_budget" class="form-control" step="0.01" min="0" required value="<?= e($row['proposed_budget']) ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i>Update Proposal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- ========================================== -->
<!-- Delete Confirmation Modal                  -->
<!-- ========================================== -->
<div class="modal fade" id="deleteProposalModal" tabindex="-1" aria-labelledby="deleteProposalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= url('orgleadership/proposals/delete') ?>" id="deleteProposalForm">
                <?= csrf_field() ?>
                <input type="hidden" name="proposal_id" id="deleteProposalId" value="">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteProposalLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete the proposal <strong id="deleteProposalTitle"></strong>? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- Vanilla JavaScript                         -->
<!-- ========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Filter auto-submit on dropdown change ──
    const filterForm  = document.getElementById('filterForm');
    const filterOrg   = document.getElementById('filterOrg');
    const filterStatus = document.getElementById('filterStatus');

    if (filterOrg) {
        filterOrg.addEventListener('change', function () {
            filterForm.submit();
        });
    }
    if (filterStatus) {
        filterStatus.addEventListener('change', function () {
            filterForm.submit();
        });
    }

    // ── Client-side table search ──
    const searchInput = document.getElementById('tableSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows  = document.querySelectorAll('#proposalsTable tbody tr');
            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    // ── Delete modal wiring ──
    const deleteModal      = document.getElementById('deleteProposalModal');
    const deleteIdInput    = document.getElementById('deleteProposalId');
    const deleteTitleSpan  = document.getElementById('deleteProposalTitle');

    document.querySelectorAll('.btn-delete-proposal').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const id    = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            deleteIdInput.value        = id;
            deleteTitleSpan.textContent = title;
            const bsModal = new bootstrap.Modal(deleteModal);
            bsModal.show();
        });
    });

});
</script>
