<?php
\Core\View::partial('header', ['title' => $title ?? 'MarSU ERP', 'bodyClass' => $bodyClass ?? '']);
?>

<div id="app-wrapper">
    <!-- Dynamic Sidebar -->
    <?php \Core\View::partial('sidebar'); ?>

    <!-- Main Content Area -->
    <div id="app-main">
        <!-- Top Navigation Bar -->
        <?php \Core\View::partial('topbar'); ?>

        <!-- Page View Container -->
        <main class="page-container">
            <!-- Breadcrumbs -->
            <?php \Core\View::partial('breadcrumbs', ['crumbs' => $crumbs ?? []]); ?>

            <!-- Flash Alert Fallback if JS Disabled -->
            <?php if (\Core\Session::hasFlash('error_inline')): ?>
                <div class="alert alert-danger alert-dismissible fade show alert-auto-dismiss" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= e(\Core\Session::getFlash('error_inline')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (\Core\Session::hasFlash('success_inline')): ?>
                <div class="alert alert-success alert-dismissible fade show alert-auto-dismiss" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i><?= e(\Core\Session::getFlash('success_inline')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <?= $content ?>
        </main>

        <!-- Standard Footer -->
        <?php \Core\View::partial('footer'); ?>
    </div>
</div>

<?php
\Core\View::partial('scripts');
?>
