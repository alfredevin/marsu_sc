<!-- Floating Scroll To Top Button -->
<button id="scrollToTopBtn" class="btn btn-marsu rounded-circle position-fixed shadow-sm" 
        style="bottom: 25px; right: 25px; width: 44px; height: 44px; display: none; align-items: center; justify-content: center; z-index: 1050;" 
        title="Scroll to Top">
    <i class="bi bi-chevron-up"></i>
</button>

<!-- Flash Notifications Messenger Hook for SweetAlert2 -->
<?php if (\Core\Session::hasFlash('success')): ?>
    <div data-flash-success="<?= e(\Core\Session::getFlash('success')) ?>" style="display:none;"></div>
<?php endif; ?>
<?php if (\Core\Session::hasFlash('error')): ?>
    <div data-flash-error="<?= e(\Core\Session::getFlash('error')) ?>" style="display:none;"></div>
<?php endif; ?>
<?php if (\Core\Session::hasFlash('info')): ?>
    <div data-flash-info="<?= e(\Core\Session::getFlash('info')) ?>" style="display:none;"></div>
<?php endif; ?>

<!-- Offline Vendor JavaScript Bundles (100% Local, Zero CDN) -->
<script src="<?= asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= asset('assets/vendor/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= asset('assets/vendor/chart.js/chart.umd.min.js') ?>"></script>

<!-- MarSU Core Vanilla Client Engine -->
<script src="<?= asset('assets/js/app.js') ?>"></script>
</body>
</html>
