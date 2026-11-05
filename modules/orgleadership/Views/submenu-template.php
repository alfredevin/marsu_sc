<div class="container-fluid py-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-marsu-burgundy text-white d-flex justify-content-between align-items-center">
            <h1 class="h5 mb-0">
                <i class="bi bi-award-fill me-2"></i><?= e($title) ?>
            </h1>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-sm btn-light">
                <i class="bi bi-grid me-1"></i>Module dashboard
            </a>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">
                Manage <?= e(strtolower($title)) ?> for the Student Organization and Leadership Management Module.
            </p>
            <div class="alert alert-info mb-0" role="status">
                <i class="bi bi-info-circle me-2"></i>
                No records are available yet. Use this workspace to add and manage <?= e(strtolower($title)) ?>.
            </div>
        </div>
    </div>
</div>
