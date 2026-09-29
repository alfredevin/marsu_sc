<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">RBAC Permission Matrix</h1>
        <p class="text-muted small mb-0">Assign granular privileges to roles across Core features and Student Modules.</p>
    </div>
    <div>
        <a href="<?= url('roles') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Roles List
        </a>
    </div>
</div>

<!-- Role Selector Tabs -->
<div class="card mb-4 border-0 shadow-sm bg-light">
    <div class="card-body py-2 px-3">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="small font-weight-bold text-muted me-2"><i class="bi bi-person-badge text-gold me-1"></i>Select Role:</span>
            <?php foreach ($allRoles as $r): ?>
                <a href="<?= url('roles/matrix', ['role_id' => $r['id']]) ?>" 
                   class="btn btn-sm <?= ($r['id'] == $currentRole['id']) ? 'btn-marsu' : 'btn-outline-secondary bg-white' ?>">
                    <?= e($r['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<form method="POST" action="<?= url('roles/sync') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="role_id" value="<?= e($currentRole['id']) ?>">

    <div class="card mb-4">
        <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
            <div>
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">
                    <i class="bi bi-shield-check me-2"></i>Privileges for Role: <u><?= e($currentRole['name']) ?></u>
                </h6>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAllCheckboxes(true)">Check All</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAllCheckboxes(false)">Uncheck All</button>
                <button type="submit" class="btn btn-accent btn-sm font-weight-bold">
                    <i class="bi bi-check2-circle me-1"></i>Save Role Privileges
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            <?php if ($currentRole['slug'] === 'super_admin'): ?>
                <div class="alert alert-warning mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Super Administrator Role Note:</strong> The <code>super_admin</code> role possesses universal wildcard access (`*`) across all existing and future modules by default.
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <?php foreach ($groupedPermissions as $moduleSlug => $perms): ?>
                    <div class="col-lg-6">
                        <div class="border rounded p-3 h-100 bg-white shadow-xs">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                <h6 class="font-weight-bold text-marsu-burgundy mb-0 text-uppercase small">
                                    <i class="bi bi-folder-fill text-gold me-1"></i><?= e(strtoupper($moduleSlug)) ?> MODULE
                                </h6>
                                <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none text-muted" 
                                        onclick="toggleModuleCheckboxes('<?= e($moduleSlug) ?>')">
                                    Toggle All
                                </button>
                            </div>

                            <div class="d-flex flex-column gap-2" id="module_group_<?= e($moduleSlug) ?>">
                                <?php foreach ($perms as $p): ?>
                                    <?php $checked = in_array((int)$p['id'], $assignedPermIds, true) || $currentRole['slug'] === 'super_admin'; ?>
                                    <div class="form-check">
                                        <input class="form-check-input perm-checkbox mod-<?= e($moduleSlug) ?>" 
                                               type="checkbox" 
                                               name="permissions[]" 
                                               value="<?= $p['id'] ?>" 
                                               id="perm_<?= $p['id'] ?>"
                                               <?= $checked ? 'checked' : '' ?>
                                               <?= ($currentRole['slug'] === 'super_admin') ? 'disabled' : '' ?>>
                                        <label class="form-check-label small" for="perm_<?= $p['id'] ?>">
                                            <strong><code><?= e($p['name']) ?></code></strong>
                                            <?php if (!empty($p['description'])): ?>
                                                <span class="text-muted d-block" style="font-size: 0.78rem;"><?= e($p['description']) ?></span>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="card-footer bg-light text-end py-3">
            <button type="submit" class="btn btn-accent px-4 font-weight-bold" <?= ($currentRole['slug'] === 'super_admin') ? 'disabled' : '' ?>>
                <i class="bi bi-save me-1"></i>Save Role Privileges
            </button>
        </div>
    </div>
</form>

<script>
function toggleAllCheckboxes(state) {
    document.querySelectorAll('.perm-checkbox:not(:disabled)').forEach(cb => cb.checked = state);
}
function toggleModuleCheckboxes(mod) {
    const cbs = document.querySelectorAll('.mod-' + mod + ':not(:disabled)');
    const anyUnchecked = Array.from(cbs).some(cb => !cb.checked);
    cbs.forEach(cb => cb.checked = anyUnchecked);
}
</script>
