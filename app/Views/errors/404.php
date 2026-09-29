<div class="text-center py-5">
    <div class="display-1 text-gold font-weight-bold mb-3" style="color: var(--marsu-gold);"><i class="bi bi-question-circle"></i> 404</div>
    <h2 class="h4 font-weight-bold text-marsu-burgundy mb-2">Page Not Found</h2>
    <p class="text-muted max-w-500 mx-auto mb-4">
        The requested path <code class="text-danger"><?= e($uri ?? '') ?></code> was not found on this system or the module may be disabled.
    </p>
    <div>
        <a href="<?= url('dashboard') ?>" class="btn btn-marsu me-2"><i class="bi bi-house-door me-2"></i>Return to Dashboard</a>
        <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Go Back</a>
    </div>
</div>
