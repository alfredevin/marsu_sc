<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1"><i class="bi bi-person-lines-fill me-2 text-gold"></i>Membership Records</h1>
            <p class="text-muted small mb-0">Directory of students associated with each registered organization.</p>
        </div>
        <div class="d-flex gap-2">
            <?php if ($organizations): ?><button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#addMemberModal"><i class="bi bi-person-plus me-1"></i>Add member</button><?php endif; ?>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Dashboard</a>
        </div>
    </div>

    <?php if (!$organizations): ?>
        <div class="alert alert-info">Register an organization before adding members.</div>
    <?php else: ?>
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span><i class="bi bi-table me-2"></i>Member directory</span>
                <form method="get" action="<?= e(url('orgleadership/membership-records')) ?>" class="d-flex gap-2">
                    <label class="visually-hidden" for="organization_id">Organization</label>
                    <select class="form-select form-select-sm" id="organization_id" name="organization_id" onchange="this.form.submit()">
                        <?php foreach ($organizations as $organization): ?><option value="<?= (int)$organization['id'] ?>" <?= $organizationId === (int)$organization['id'] ? 'selected' : '' ?>><?= e($organization['name']) ?> (<?= e($organization['acronym']) ?>)</option><?php endforeach; ?>
                    </select>
                    <button class="btn btn-sm btn-outline-marsu" type="submit">Load</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-marsu"><tr><th>#</th><th>Member name</th><th>Student number</th><th>Organization</th><th>Role</th><th>Date joined</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                    <tbody>
                    <?php if (!$members): ?><tr><td colspan="8" class="text-center text-muted py-5"><i class="bi bi-person-x fs-2 d-block mb-2"></i>No membership records found for this organization.</td></tr><?php endif; ?>
                    <?php foreach ($members as $index => $member): ?><tr><td><?= $index + 1 ?></td><td><strong><?= e($member['member_name']) ?></strong></td><td><?= e($member['student_number'] ?? '-') ?></td><td><?= e($selectedOrganization['name'] ?? 'Organization') ?></td><td><span class="badge bg-light text-dark border"><?= e($member['role']) ?></span></td><td><?= e($member['joined_at'] ?? '-') ?></td><td><span class="badge <?= $member['status'] === 'Active' ? 'bg-success' : ($member['status'] === 'Suspended' ? 'bg-warning text-dark' : 'bg-secondary') ?>"><?= e($member['status']) ?></span></td><td class="text-end"><button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#statusMember<?= (int)$member['id'] ?>"><i class="bi bi-person-gear me-1"></i>Status</button></td></tr><?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <?php foreach ($members as $member): ?>
    <div class="modal fade" id="statusMember<?= (int)$member['id'] ?>" tabindex="-1" aria-labelledby="statusMemberLabel<?= (int)$member['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title h5" id="statusMemberLabel<?= (int)$member['id'] ?>"><i class="bi bi-person-gear me-2"></i>Update membership status</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <form method="post" action="<?= e(url('orgleadership/members/status')) ?>">
                <?= csrf_field() ?><input type="hidden" name="member_id" value="<?= (int)$member['id'] ?>"><input type="hidden" name="organization_id" value="<?= (int)$organizationId ?>">
                <div class="modal-body"><p class="small text-muted">Update status for <strong><?= e($member['member_name']) ?></strong>.</p><label class="form-label" for="member-status-<?= (int)$member['id'] ?>">Membership status</label><select class="form-select" id="member-status-<?= (int)$member['id'] ?>" name="status" required><?php foreach ($memberStatuses as $status): ?><option value="<?= e($status) ?>" <?= $member['status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option><?php endforeach; ?></select></div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-save me-1"></i>Save status</button></div>
            </form>
        </div></div>
    </div>
    <?php endforeach; ?>
</div>

<?php if ($organizations): ?>
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow">
        <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title h5" id="addMemberModalLabel"><i class="bi bi-person-plus me-2"></i>Add membership record</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <form method="post" action="<?= e(url('orgleadership/members/store')) ?>"><?= csrf_field() ?><div class="modal-body">
            <input type="hidden" name="organization_id" value="<?= (int)$organizationId ?>">
            <div class="mb-3"><label class="form-label" for="member-name">Member name <span class="text-danger">*</span></label><input class="form-control" id="member-name" name="member_name" maxlength="191" required></div>
            <div class="mb-3"><label class="form-label" for="student-number">Student number</label><input class="form-control" id="student-number" name="student_number" maxlength="50"></div>
            <div class="row g-3"><div class="col-md-6"><label class="form-label" for="member-role">Role</label><select class="form-select" id="member-role" name="role"><option>Member</option><option>Officer</option><option>Committee Head</option><option>Adviser</option></select></div><div class="col-md-6"><label class="form-label" for="joined-at">Date joined</label><input class="form-control" id="joined-at" name="joined_at" type="date"></div></div>
        </div><div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-save me-1"></i>Save member</button></div></form>
    </div></div>
</div>
<?php endif; ?>
