<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-award-fill me-2 text-gold"></i><?= e($moduleName) ?>
        </h1>
        <p class="text-muted small mb-0">Manage registered organizations, accreditation, leadership, and student activities.</p>
    </div>
    <div class="d-flex gap-2">
        <a class="btn btn-outline-marsu btn-sm" href="<?= e(url('orgleadership/organization-profile')) ?>">
            <i class="bi bi-building-gear me-1"></i>Organization profiles
        </a>
        <a class="btn btn-marsu btn-sm" href="<?= e(url('orgleadership/organization-registration')) ?>">
            <i class="bi bi-plus-lg me-1"></i>Register organization
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card card-kpi border-burgundy p-3 h-100">
            <div class="text-muted small text-uppercase fw-bold">Registered organizations</div>
            <div class="h3 fw-bold mb-0 text-marsu-burgundy"><?= (int)($stats['organizations'] ?? 0) ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card card-kpi border-gold p-3 h-100">
            <div class="text-muted small text-uppercase fw-bold">Active organizations</div>
            <div class="h3 fw-bold mb-0 text-marsu-burgundy"><?= (int)($stats['active'] ?? 0) ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card card-kpi p-3 h-100">
            <div class="text-muted small text-uppercase fw-bold">Awaiting accreditation</div>
            <div class="h3 fw-bold mb-0 text-marsu-burgundy"><?= (int)($stats['pending'] ?? 0) ?></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h2 class="h6 mb-0 fw-bold text-marsu-burgundy"><i class="bi bi-buildings me-2"></i>Recently registered organizations</h2>
        <a class="small" href="<?= e(url('orgleadership/organization-registration')) ?>">View registration workspace</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-marsu">
                <tr><th>Organization</th><th>Classification</th><th>School year</th><th>Status</th><th>Accreditation date</th><th class="text-end">Action</th></tr>
            </thead>
            <tbody>
                <?php if (empty($organizations)): ?>
                    <tr><td colspan="6" class="text-center py-4 text-muted">No organizations have been registered yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($organizations as $organization): ?>
                        <tr>
                            <td><strong><?= e($organization['name']) ?></strong><small class="d-block text-muted"><?= e($organization['acronym']) ?></small></td>
                            <td><?= e($organization['category'] ?? 'Unclassified') ?></td>
                            <td><?= e($organization['school_year'] ?? '-') ?></td>
                            <td><span class="badge <?= $organization['status'] === 'Active' ? 'bg-success' : ($organization['status'] === 'Inactive' ? 'bg-secondary' : 'bg-warning text-dark') ?>"><?= e($organization['status']) ?></span></td>
                            <td><?= e($organization['accreditation_date'] ? date('M d, Y', strtotime($organization['accreditation_date'])) : '-') ?></td>
                            <td class="text-end"><a class="btn btn-sm btn-outline-marsu" href="<?= e(url('orgleadership/organization-profile?id=' . (int)$organization['id'])) ?>"><i class="bi bi-eye me-1"></i>Open</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
