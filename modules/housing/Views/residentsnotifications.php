<!-- Residents Notifications View -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-bell-fill me-2 text-gold"></i><?= e($title ?? 'Residents Notifications') ?>
        </h1>
        <p class="text-muted small mb-0">Housing & Accommodation Management System (ISHAMIS)</p>
    </div>
    <div>
        <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Overview
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body text-center py-5">
        <div class="mb-3">
            <i class="bi bi-bell display-4 text-warning"></i>
        </div>
        <h5 class="text-marsu-burgundy fw-bold"><?= e($title ?? 'Residents Notifications') ?></h5>
        <p class="text-muted mb-3">Notice board and resident communication logs are managed here.</p>
        <a href="<?= url('housing') ?>" class="btn btn-marsu btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Return to Housing Dashboard
        </a>
    </div>
</div>
