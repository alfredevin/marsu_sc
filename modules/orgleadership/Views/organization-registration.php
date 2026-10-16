<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h4 text-marsu-burgundy mb-1"><i class="bi bi-patch-check me-2"></i><?= e($title) ?></h1>
            <p class="text-muted mb-0">Review registered organizations and submit new organizations for accreditation.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Dashboard</a>
            <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#organizationRegistrationModal"><i class="bi bi-plus-circle me-1"></i>Register organization</button>
        </div>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center"><span><i class="bi bi-list-check me-2"></i>Accreditation queue</span><span class="badge badge-gold"><?= count($organizations) ?> organizations</span></div>
        <div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>Organization</th><th>Category</th><th>Faculty adviser</th><th>Submitted</th><th>Status</th><th class="text-end">Action</th></tr></thead><tbody>
        <?php if (!$organizations): ?><tr><td colspan="6" class="text-center text-muted py-5"><i class="bi bi-inbox fs-2 d-block mb-2"></i>No organizations registered yet.</td></tr><?php endif; ?>
        <?php foreach ($organizations as $organization): ?><tr><td><strong><?= e($organization['name']) ?></strong><small class="d-block text-muted"><?= e($organization['acronym']) ?></small></td><td><?= e($organization['category']) ?></td><td><?= e($organization['adviser']) ?></td><td><?= e(date('M d, Y', strtotime($organization['created_at']))) ?></td><td><span class="badge <?= $organization['status'] === 'Active' ? 'bg-success' : 'bg-warning text-dark' ?>"><?= e($organization['status']) ?></span></td><td class="text-end"><a class="btn btn-sm btn-outline-marsu" href="<?= e(url('orgleadership/organization-profile', ['id' => (int)$organization['id']])) ?>"><i class="bi bi-eye me-1"></i>Profile</a></td></tr><?php endforeach; ?>
        </tbody></table></div>
    </div>
</div>

<div class="modal fade" id="organizationRegistrationModal" tabindex="-1" aria-labelledby="organizationRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow">
        <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title h5" id="organizationRegistrationModalLabel"><i class="bi bi-building-add me-2"></i>Register and accredit organization</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <form method="post" action="<?= e(url('orgleadership/organizations/store')) ?>"><?= csrf_field() ?><div class="modal-body">
            <p class="small text-muted">New submissions start as <strong>Pending Accreditation</strong>. Update the result in Classification and Status Tracking.</p>
            <div class="row g-3"><div class="col-md-8"><label class="form-label" for="registration-name">Organization name <span class="text-danger">*</span></label><input class="form-control" id="registration-name" name="name" maxlength="191" required></div><div class="col-md-4"><label class="form-label" for="registration-acronym">Acronym <span class="text-danger">*</span></label><input class="form-control text-uppercase" id="registration-acronym" name="acronym" maxlength="50" required></div><div class="col-md-6"><label class="form-label" for="registration-category">Category <span class="text-danger">*</span></label><select class="form-select" id="registration-category" name="category" required><option value="">Select category</option><option>Academic</option><option>College-based</option><option>Special interest</option><option>Student governance</option><option>Socio-cultural</option><option>Sports</option></select></div><div class="col-md-6"><label class="form-label" for="registration-adviser">Faculty adviser <span class="text-danger">*</span></label><input class="form-control" id="registration-adviser" name="adviser" maxlength="191" required></div><div class="col-12"><label class="form-label" for="registration-description">Organization description</label><textarea class="form-control" id="registration-description" name="description" rows="4" maxlength="5000"></textarea></div></div>
        </div><div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-send me-1"></i>Submit for accreditation</button></div></form>
    </div></div>
</div>
