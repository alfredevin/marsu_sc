<?php
if (!empty($crumbs) && is_array($crumbs)):
?>
<nav aria-label="breadcrumb" class="breadcrumb-marsu">
    <ol class="breadcrumb mb-0 py-1 bg-transparent small">
        <li class="breadcrumb-item">
            <a href="<?= url('dashboard') ?>"><i class="bi bi-house-door-fill text-muted me-1"></i>Home</a>
        </li>
        <?php foreach ($crumbs as $label => $targetUrl): ?>
            <?php if (!empty($targetUrl)): ?>
                <li class="breadcrumb-item"><a href="<?= e($targetUrl) ?>"><?= e($label) ?></a></li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page"><?= e($label) ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
