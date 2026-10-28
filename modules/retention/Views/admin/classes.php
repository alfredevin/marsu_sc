<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring & Governance
 * View: Admin Class Offerings & Faculty Teaching Assignments (admin/classes.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-3">
    <!-- Breadcrumb & Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <i class="bi bi-mortarboard-fill me-2 text-marsu-burgundy"></i>Class Offerings & Faculty Assignments
            </h4>
            <p class="text-secondary small mb-0">Manage course sections, assign teaching faculty, and oversee term closure workflows.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('retention/admin/classes/create') ?>" class="btn btn-marsu btn-sm">
                <i class="bi bi-plus-circle me-1"></i>New Class Offering
            </a>
            <?php if (!empty($activeSemester)): ?>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#closeTermModal">
                    <i class="bi bi-lock-fill me-1"></i>Close Current Term
                </button>
            <?php endif; ?>
        </div>
    </div>

    <!-- Governance Information Banner -->
    <div class="alert alert-light border border-secondary-subtle d-flex align-items-center py-2 px-3 mb-4 shadow-sm" role="alert">
        <i class="bi bi-person-workspace fs-5 me-3 text-marsu-burgundy"></i>
        <div class="small">
            <strong class="d-block text-dark">Faculty Assignment & Oversight Principle (Part E3)</strong>
            <span class="text-secondary">
                Administrators create course offerings and assign teaching faculty. Reassigning a class requires an official justification and is permanently logged. 
                Administrators <strong>never encode task scores or submit grades</strong>; they view class records in read-only mode.
            </span>
        </div>
    </div>

    <!-- Class Offerings Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold text-dark fs-6">
                <i class="bi bi-collection me-2 text-marsu-burgundy"></i>Active Class Offerings
            </span>
            <span class="badge bg-secondary-subtle text-secondary small"><?= count($classes) ?> Classes</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-3" style="width: 50px;">#</th>
                            <th>Subject & Section</th>
                            <th>Term / Semester</th>
                            <th>Assigned Faculty</th>
                            <th>Enrolled</th>
                            <th>Scores Recorded</th>
                            <th>Grade Status</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($classes)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    <p class="mb-0 fw-semibold">No class offerings registered yet</p>
                                    <small>Click "New Class Offering" above to assign a subject and section to a faculty member.</small>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($classes as $idx => $cls): ?>
                                <tr>
                                    <td class="ps-3 fw-bold text-muted"><?= $idx + 1 ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= e($cls['subject_code']) ?> — <?= e($cls['section_name']) ?></div>
                                        <small class="text-muted"><?= e($cls['subject_title']) ?> (<?= e($cls['units']) ?> units)</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?= e($cls['semester_name'] ?? 'Term') ?> • <?= e($cls['academic_year_label'] ?? 'AY') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($cls['faculty_name'])): ?>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-marsu text-white d-flex align-items-center justify-content-center me-2 fw-bold" 
                                                     style="width: 28px; height: 28px; font-size: 11px;">
                                                    <?= strtoupper(substr($cls['faculty_name'], 0, 1)) ?>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold text-dark d-block"><?= e($cls['faculty_name']) ?></span>
                                                    <small class="text-muted" style="font-size: 11px;"><?= e($cls['faculty_email']) ?></small>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Unassigned</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-people me-1"></i><?= (int) ($cls['student_count'] ?? 0) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ((int) ($cls['score_count'] ?? 0) > 0): ?>
                                            <span class="badge bg-info-subtle text-info border border-info-subtle">
                                                <?= (int) $cls['score_count'] ?> scores
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border">None yet</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cls['grade_status'] === 'locked'): ?>
                                            <span class="badge bg-secondary text-white"><i class="bi bi-lock-fill me-1"></i>Locked</span>
                                        <?php elseif ($cls['grade_status'] === 'posted'): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">
                                                <i class="bi bi-check-circle-fill me-1"></i>Posted
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-warning-subtle text-dark border border-warning-subtle">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group btn-group-sm">
                                            <!-- Read-only Oversight View -->
                                            <a href="<?= url("retention/admin/classes/{$cls['id']}") ?>" 
                                               class="btn btn-outline-secondary" title="View Class Record (Read-Only)">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Reassign Faculty Button -->
                                            <button type="button" class="btn btn-outline-secondary" title="Reassign Faculty Member" 
                                                onclick="openReassignModal(<?= (int)$cls['id'] ?>, '<?= e(addslashes($cls['subject_code'] . ' - ' . $cls['section_name'])) ?>', <?= (int)($cls['faculty_user_id'] ?? 0) ?>)">
                                                <i class="bi bi-person-gear"></i>
                                            </button>

                                            <!-- Archive Button (Disabled if scores exist) -->
                                            <?php if ((int) ($cls['score_count'] ?? 0) === 0): ?>
                                                <button type="button" class="btn btn-outline-danger" title="Archive Class" 
                                                    onclick="openArchiveModal(<?= (int)$cls['id'] ?>, '<?= e(addslashes($cls['subject_code'] . ' - ' . $cls['section_name'])) ?>')">
                                                    <i class="bi bi-archive"></i>
                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-outline-secondary disabled" title="Cannot archive: Class has recorded scores" disabled>
                                                    <i class="bi bi-archive"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Reassignment Reason Modal -->
<div class="modal fade" id="reassignFacultyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="reassignFacultyForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-marsu text-white">
                    <h5 class="modal-title fs-6"><i class="bi bi-person-gear me-2"></i>Reassign Teaching Faculty</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-secondary small mb-3">
                        Reassigning instructor for <strong id="reassignClassName" class="text-dark"></strong>.
                    </p>
                    <div class="mb-3">
                        <label for="newFacultySelect" class="form-label fw-bold small text-dark">New Assigned Faculty <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="newFacultySelect" name="faculty_user_id" required>
                            <option value="">Select instructor...</option>
                            <?php foreach ($facultyList as $fac): ?>
                                <option value="<?= (int) $fac['id'] ?>">
                                    <?= e($fac['full_name']) ?> (<?= e($fac['email']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reassignReason" class="form-label fw-bold small text-dark">
                            Mandatory Justification / Reason <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-sm" id="reassignReason" name="reason" rows="3" required 
                            placeholder="State the academic administrative basis (e.g. Instructor on maternity/medical leave, load rebalancing)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-check-circle me-1"></i>Confirm Reassignment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Archive Class Reason Modal -->
<div class="modal fade" id="archiveClassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="archiveClassForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fs-6"><i class="bi bi-archive me-2"></i>Archive Class Offering</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-secondary small mb-3">
                        Are you sure you want to archive <strong id="archiveClassName" class="text-dark"></strong>? 
                        This class has no recorded student scores and will be soft-deleted.
                    </p>
                    <div class="mb-3">
                        <label for="archiveReason" class="form-label fw-bold small text-dark">
                            Mandatory Reason for Deactivation <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-sm" id="archiveReason" name="reason" rows="2" required 
                            placeholder="e.g. Section dissolved, course offering cancelled..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-archive me-1"></i>Archive Offering
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Close Term Modal -->
<?php if (!empty($activeSemester)): ?>
<div class="modal fade" id="closeTermModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="<?= url("retention/admin/terms/{$activeSemester['id']}/close") ?>">
                <?= csrf_field() ?>
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fs-6"><i class="bi bi-lock-fill me-2"></i>Close Academic Term</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="small text-secondary mb-3">
                        Closing <strong><?= e($activeSemester['name']) ?></strong> will permanently lock all <strong>Posted</strong> class grade records, preventing further grade modifications unless formally unlocked through an approved correction workflow.
                    </p>
                    <?php if (($unpostedCount ?? 0) > 0): ?>
                        <div class="alert alert-warning py-2 px-3 small mb-3">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            <strong>Warning:</strong> There are <strong><?= (int) $unpostedCount ?></strong> class(es) still in Draft status. Unposted draft classes will remain open.
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="closeTermReason" class="form-label fw-bold small text-dark">
                            Term Closure Authorization Memo <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-sm" id="closeTermReason" name="reason" rows="2" required 
                            placeholder="e.g. Official Registrar term grade encoding deadline elapsed..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm">
                        <i class="bi bi-lock-fill me-1"></i>Confirm Term Closure
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
function openReassignModal(classId, className, currentFacultyId) {
    document.getElementById('reassignClassName').textContent = className;
    const form = document.getElementById('reassignFacultyForm');
    form.action = '<?= url('retention/admin/classes/') ?>' + classId + '/assign';
    const select = document.getElementById('newFacultySelect');
    select.value = currentFacultyId || '';
    const modal = new bootstrap.Modal(document.getElementById('reassignFacultyModal'));
    modal.show();
}

function openArchiveModal(classId, className) {
    document.getElementById('archiveClassName').textContent = className;
    const form = document.getElementById('archiveClassForm');
    form.action = '<?= url('retention/admin/classes/') ?>' + classId + '/archive';
    const modal = new bootstrap.Modal(document.getElementById('archiveClassModal'));
    modal.show();
}
</script>
