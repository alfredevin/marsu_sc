<div class="text-center py-5">
    <div class="display-1 text-danger font-weight-bold mb-3"><i class="bi bi-shield-x"></i> 403</div>
    <h2 class="h4 font-weight-bold text-marsu-burgundy mb-2">Access Denied / Forbidden</h2>
    <p class="text-muted max-w-500 mx-auto mb-4">
        You do not possess the required RBAC security permission to access this resource or execute this action.
        <?php if (!empty($permissionKey)): ?>
            <br><code class="badge bg-light text-danger border mt-2">Required Privilege: <?= e($permissionKey) ?></code>
        <?php endif; ?>
    </p>
    <div>
        <a href="<?= url('dashboard') ?>" class="btn btn-marsu me-2"><i class="bi bi-house-door me-2"></i>Return to Dashboard</a>
        <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Go Back</a>
    </div>
</div>
