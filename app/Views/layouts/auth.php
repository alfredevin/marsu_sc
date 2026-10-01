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
                <h1 class="auth-hero-brand-title">MarSU Centralized ERP</h1>
                <div class="auth-hero-brand-sub">COLLEGE OF INFORMATION &amp; COMPUTING SCIENCES</div>
            </div>
        </div>

        <!-- Center Value Proposition & Workflow Badges -->
        <div class="auth-hero-content">
            <h2 class="auth-hero-headline">
                Centralized university services,<br>
                <span class="auth-hero-gold">effortlessly managed.</span>
            </h2>

            <div class="auth-hero-features">
                <!-- Feature 1: Role-Based Unified Access -->
                <div class="auth-feature-item">
                    <div class="auth-feature-icon-badge">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <div>
                        <div class="auth-feature-title">Role-Based Unified Access</div>
                        <p class="auth-feature-desc">
                            Centralized, secure multi-role ERP authentication for students, faculty, department chairs, deans, and administrators.
                        </p>
                    </div>
                </div>

                <!-- Feature 2: Real-Time Executive Telemetry -->
                <div class="auth-feature-item">
                    <div class="auth-feature-icon-badge">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div>
                        <div class="auth-feature-title">Real-Time Executive Telemetry</div>
                        <p class="auth-feature-desc">
                            Live university KPIs, student enrollment analytics, and cross-departmental operations tracking in real-time.
                        </p>
                    </div>
                </div>

                <!-- Feature 3: 11 Integrated Sub-Modules -->
                <div class="auth-feature-item">
                    <div class="auth-feature-icon-badge">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                    </div>
                    <div>
                        <div class="auth-feature-title">11 Integrated Sub-Modules</div>
                        <p class="auth-feature-desc">
                            Seamless interoperability across Student Clearance, 4Ps Monitoring, Health Clinic, Guidance, Welfare, Assets, and Faculty Workload.
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
