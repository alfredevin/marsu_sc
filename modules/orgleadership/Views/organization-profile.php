<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1"><i class="bi bi-building me-2 text-gold"></i>Organization Profile Management</h1>
            <p class="text-muted small mb-0">Directory of registered student organizations and their official profile details.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#organizationRegistrationModal"><i class="bi bi-plus-circle me-1"></i>Register organization</button>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Dashboard</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-list-ul me-2"></i>Organization profile list</span>
            <span class="badge badge-gold"><?= count($organizations) ?> records</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-marsu">
                    <tr>
                        <th>#</th>
                        <th>Organization name / acronym</th>
                        <th>Category</th>
                        <th>Faculty adviser</th>
                        <th>Classification / status</th>
                        <th>Accreditation date</th>
                        <th>Date registered</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$organizations): ?>
                    <tr><td colspan="8" class="text-center text-muted py-5"><i class="bi bi-inbox fs-2 d-block mb-2"></i>No organization profiles found.</td></tr>
                <?php endif; ?>
                <?php foreach ($organizations as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= e($item['name']) ?></strong><small class="d-block text-muted"><?= e($item['acronym']) ?></small></td>
                        <td><?= e($item['category']) ?></td>
                        <td><?= e($item['adviser']) ?></td>
                        <td><span class="badge <?= $item['status'] === 'Active' ? 'bg-success' : ($item['status'] === 'Inactive' ? 'bg-secondary' : 'bg-warning text-dark') ?>"><?= e($item['status']) ?></span></td>
                        <td><?= e($item['accreditation_date'] ? date('M d, Y', strtotime($item['accreditation_date'])) : '-') ?></td>
                        <td><?= e(date('M d, Y', strtotime($item['created_at']))) ?></td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <button type="button" class="btn btn-sm btn-outline-marsu" data-bs-toggle="modal" data-bs-target="#editOrganization<?= (int)$item['id'] ?>"><i class="bi bi-pencil me-1"></i>Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#statusOrganization<?= (int)$item['id'] ?>"><i class="bi bi-shield-check me-1"></i>Status</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($organizations as $item): ?>
<div class="modal fade" id="statusOrganization<?= (int)$item['id'] ?>" tabindex="-1" aria-labelledby="statusOrganizationLabel<?= (int)$item['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow">
        <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title h5" id="statusOrganizationLabel<?= (int)$item['id'] ?>"><i class="bi bi-shield-check me-2"></i>Update classification and status</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <form method="post" action="<?= e(url('orgleadership/organizations/status')) ?>">
            <?= csrf_field() ?><input type="hidden" name="organization_id" value="<?= (int)$item['id'] ?>">
            <div class="modal-body">
                <p class="small text-muted mb-3"><?= e($item['name']) ?> (<?= e($item['acronym']) ?>)</p>
                <div class="mb-3"><label class="form-label" for="organization-status-<?= (int)$item['id'] ?>">Classification / status <span class="text-danger">*</span></label><select class="form-select" id="organization-status-<?= (int)$item['id'] ?>" name="status" required><?php foreach ($statuses as $status): ?><option value="<?= e($status) ?>" <?= $item['status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option><?php endforeach; ?></select></div>
                <div><label class="form-label" for="accreditation-date-<?= (int)$item['id'] ?>">Accreditation date</label><input class="form-control" id="accreditation-date-<?= (int)$item['id'] ?>" name="accreditation_date" type="date" value="<?= e($item['accreditation_date'] ?? '') ?>"><div class="form-text">Use the date approved by the accrediting office.</div></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-save me-1"></i>Save status</button></div>
        </form>
    </div></div>
</div>
<?php endforeach; ?>

<?php foreach ($organizations as $item): ?>
<div class="modal fade" id="editOrganization<?= (int)$item['id'] ?>" tabindex="-1" aria-labelledby="editOrganizationLabel<?= (int)$item['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content border-0 shadow">
        <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title h5" id="editOrganizationLabel<?= (int)$item['id'] ?>"><i class="bi bi-pencil-square me-2"></i>Edit organization profile</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <form method="post" action="<?= e(url('orgleadership/organizations/update')) ?>">
            <?= csrf_field() ?><input type="hidden" name="organization_id" value="<?= (int)$item['id'] ?>">
            <div class="modal-body"><div class="row g-3">
                <div class="col-md-8"><label class="form-label" for="profile-name-<?= (int)$item['id'] ?>">Organization name <span class="text-danger">*</span></label><input class="form-control" id="profile-name-<?= (int)$item['id'] ?>" name="name" value="<?= e($item['name']) ?>" maxlength="191" required></div>
                <div class="col-md-4"><label class="form-label" for="profile-acronym-<?= (int)$item['id'] ?>">Acronym <span class="text-danger">*</span></label><input class="form-control text-uppercase" id="profile-acronym-<?= (int)$item['id'] ?>" name="acronym" value="<?= e($item['acronym']) ?>" maxlength="50" required></div>
                <div class="col-md-6"><label class="form-label" for="profile-category-<?= (int)$item['id'] ?>">Category <span class="text-danger">*</span></label><input class="form-control" id="profile-category-<?= (int)$item['id'] ?>" name="category" value="<?= e($item['category']) ?>" maxlength="100" required></div>
                <div class="col-md-6"><label class="form-label" for="profile-adviser-<?= (int)$item['id'] ?>">Faculty adviser <span class="text-danger">*</span></label><input class="form-control" id="profile-adviser-<?= (int)$item['id'] ?>" name="adviser" value="<?= e($item['adviser']) ?>" maxlength="191" required></div>
                <div class="col-md-6"><label class="form-label" for="profile-status-<?= (int)$item['id'] ?>">Classification / status <span class="text-danger">*</span></label><select class="form-select" id="profile-status-<?= (int)$item['id'] ?>" name="status" required><?php foreach ($statuses as $status): ?><option value="<?= e($status) ?>" <?= $item['status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option><?php endforeach; ?></select></div>
                <div class="col-12"><label class="form-label" for="profile-description-<?= (int)$item['id'] ?>">Description</label><textarea class="form-control" id="profile-description-<?= (int)$item['id'] ?>" name="description" rows="4" maxlength="5000"><?= e($item['description'] ?? '') ?></textarea></div>
            </div></div>
            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-save me-1"></i>Save changes</button></div>
        </form>
    </div></div>
</div>
<?php endforeach; ?>

<div class="modal fade" id="organizationRegistrationModal" tabindex="-1" aria-labelledby="organizationRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content border-0 shadow">
        <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title h5" id="organizationRegistrationModalLabel"><i class="bi bi-building-add me-2"></i>Register organization for accreditation</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <form method="post" action="<?= e(url('orgleadership/organizations/store')) ?>"><?= csrf_field() ?><div class="modal-body"><p class="small text-muted">New organizations are created with <strong>Pending Accreditation</strong> status.</p><div class="row g-3">
            <div class="col-md-8"><label class="form-label" for="registration-name">Organization name <span class="text-danger">*</span></label><input class="form-control" id="registration-name" name="name" maxlength="191" required></div>
            <div class="col-md-4"><label class="form-label" for="registration-acronym">Acronym <span class="text-danger">*</span></label><input class="form-control text-uppercase" id="registration-acronym" name="acronym" maxlength="50" required></div>
            <div class="col-md-6"><label class="form-label" for="registration-category">Category <span class="text-danger">*</span></label><select class="form-select" id="registration-category" name="category" required><option value="">Select category</option><option>Academic</option><option>College-based</option><option>Special interest</option><option>Student governance</option><option>Socio-cultural</option><option>Sports</option></select></div>
            <div class="col-md-6"><label class="form-label" for="registration-adviser">Faculty adviser <span class="text-danger">*</span></label><input class="form-control" id="registration-adviser" name="adviser" maxlength="191" required></div>
            <div class="col-12"><label class="form-label" for="registration-description">Description</label><textarea class="form-control" id="registration-description" name="description" rows="4" maxlength="5000"></textarea></div>
        </div></div><div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-send me-1"></i>Submit for accreditation</button></div></form>
    </div></div>
</div>
