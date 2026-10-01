<?php
\Core\View::partial('header', ['title' => $title ?? 'Login', 'bodyClass' => 'auth-page-body']);
?>

<div class="auth-split-layout">
    <!-- Left Hero Column with MarSU Campus Background & Value Highlights -->
    <div class="auth-hero-column">
        <!-- Top University Branding -->
        <div class="auth-hero-header">
            <div class="auth-hero-logo-badge">
                <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Logo" class="auth-hero-logo-img">
            </div>
            <div>
                <h1 class="auth-hero-brand-title">MarSU eClearance</h1>
                <div class="auth-hero-brand-sub">UNIVERSITY PORTAL &bull; CICS</div>
            </div>
        </div>

        <!-- Center Value Proposition & Workflow Badges -->
        <div class="auth-hero-content">
            <h2 class="auth-hero-headline">
                Online student clearance,<br>
                <span class="auth-hero-gold">effortlessly tracked.</span>
            </h2>

            <div class="auth-hero-features">
                <!-- Feature 1: Secured Approval Workflow -->
                <div class="auth-feature-item">
                    <div class="auth-feature-icon-badge">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <div class="auth-feature-title">Secured Approval Workflow</div>
                        <p class="auth-feature-desc">
                            Digitized multi-stage clearance system with secure validations from registrar, library, cashier, and other university offices.
                        </p>
                    </div>
                </div>

                <!-- Feature 2: Instant Progress Tracking -->
                <div class="auth-feature-item">
                    <div class="auth-feature-icon-badge">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <div class="auth-feature-title">Instant Progress Tracking</div>
                        <p class="auth-feature-desc">
                            Check the active status of your clearance in real-time. View which department sign-offs are completed or pending.
                        </p>
                    </div>
                </div>

                <!-- Feature 3: Zero Physical Queues -->
                <div class="auth-feature-item">
                    <div class="auth-feature-icon-badge">
                        <i class="bi bi-check2-all"></i>
                    </div>
                    <div>
                        <div class="auth-feature-title">Zero Physical Queues</div>
                        <p class="auth-feature-desc">
                            Avoid long lines and manual paperwork by processing all clearance requirements and module workflows online.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom University System & Campus Tracker -->
        <div class="auth-hero-footer">
            <span>Marinduque State University - CICS System</span>
            <div class="auth-slider-track">
                <div class="auth-slider-dot">
                    <div class="auth-slider-dot-inner"></div>
                </div>
            </div>
            <span>SANTA CRUZ, MQE &bull; Portal 2026</span>
        </div>
    </div>

    <!-- Right Interactive Card Column -->
    <div class="auth-card-column">
        <div class="auth-glass-card">
            <!-- Flash Alerts -->
            <?php if (\Core\Session::hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4 small bg-danger bg-opacity-25 border-danger text-white" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i><?= e(\Core\Session::getFlash('error')) ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (\Core\Session::hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mb-4 small bg-success bg-opacity-25 border-success text-white" role="alert">
                    <i class="bi bi-check-circle-fill me-2 text-success"></i><?= e(\Core\Session::getFlash('success')) ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= $content ?>
        </div>
    </div>
</div>

<?php
\Core\View::partial('scripts');
?>
