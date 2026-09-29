<?php
\Core\View::partial('header', ['title' => $title ?? 'Login', 'bodyClass' => 'bg-light']);
?>

<div class="auth-wrapper">
    <!-- MarSU Brand Side (Burgundy & Gold) -->
    <div class="auth-brand-side">
        <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Official Seal" class="auth-brand-logo">
        <h1 class="h3 font-weight-bold text-white mb-1">Marinduque State University</h1>
        <h5 class="text-gold font-weight-normal mb-3" style="color: var(--marsu-gold);">College of Information and Computing Sciences</h5>
        
        <p class="auth-brand-tagline">
            "Empowering Minds, Transforming Lives, and Advancing Opportunities with HEART"
        </p>

        <div class="mt-4 pt-3 border-top border-white-50 text-white-50 small">
            Panfilo M. Manguera Sr. Rd., Brgy. Tanza, Boac, Marinduque 4900
        </div>
    </div>

    <!-- Interactive Form Side -->
    <div class="auth-form-side">
        <!-- Flash Alerts -->
        <?php if (\Core\Session::hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4 small" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= e(\Core\Session::getFlash('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (\Core\Session::hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4 small" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><?= e(\Core\Session::getFlash('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </div>
</div>

<?php
\Core\View::partial('scripts');
?>
