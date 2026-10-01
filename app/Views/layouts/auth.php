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

        <!-- Center Value Proposition & Workflow Carousel -->
        <div class="auth-hero-content" id="authHeroCarousel">
            <!-- Slide 0: Centralized ERP & Interoperability -->
            <div class="auth-carousel-slide active" data-slide-index="0">
                <h2 class="auth-hero-headline">
                    Centralized university services,<br>
                    <span class="auth-hero-gold">effortlessly managed.</span>
                </h2>

                <div class="auth-hero-features">
                    <div class="auth-feature-item">
                        <div class="auth-feature-icon-badge">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <div>
                            <div class="auth-feature-title">Role-Based Unified Access (RBAC)</div>
                            <p class="auth-feature-desc">
                                Centralized, secure multi-role ERP authentication for students, faculty, department chairs, deans, and administrators.
                            </p>
                        </div>
                    </div>

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

            <!-- Slide 1: Student Clearance & Operations -->
            <div class="auth-carousel-slide" data-slide-index="1">
                <h2 class="auth-hero-headline">
                    Online student clearance,<br>
                    <span class="auth-hero-gold">effortlessly tracked.</span>
                </h2>

                <div class="auth-hero-features">
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

            <!-- Slide 2: Compliance & Academic Leadership -->
            <div class="auth-carousel-slide" data-slide-index="2">
                <h2 class="auth-hero-headline">
                    Institutional governance,<br>
                    <span class="auth-hero-gold">securely delivered.</span>
                </h2>

                <div class="auth-hero-features">
                    <div class="auth-feature-item">
                        <div class="auth-feature-icon-badge">
                            <i class="bi bi-journal-bookmark-fill"></i>
                        </div>
                        <div>
                            <div class="auth-feature-title">Faculty Teaching Workload</div>
                            <p class="auth-feature-desc">
                                Comprehensive academic scheduling, CHED workload compliance, and subject assignment distributions.
                            </p>
                        </div>
                    </div>

                    <div class="auth-feature-item">
                        <div class="auth-feature-icon-badge">
                            <i class="bi bi-file-earmark-lock2-fill"></i>
                        </div>
                        <div>
                            <div class="auth-feature-title">Data Privacy Act (RA 10173)</div>
                            <p class="auth-feature-desc">
                                Strict data privacy protections and confidential role enforcement for Clinic, Guidance, and Welfare records.
                            </p>
                        </div>
                    </div>

                    <div class="auth-feature-item">
                        <div class="auth-feature-icon-badge">
                            <i class="bi bi-fingerprint"></i>
                        </div>
                        <div>
                            <div class="auth-feature-title">End-to-End Audit Trail</div>
                            <p class="auth-feature-desc">
                                Immutable logging of all sensitive administrative actions, permission changes, and security events.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom University System & Interactive Carousel Tracker -->
        <div class="auth-hero-footer">
            <span>Marinduque State University - CICS</span>
            <div class="auth-slider-container">
                <button type="button" class="auth-slider-arrow-btn" id="heroPrevBtn" title="Previous Feature" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div class="auth-slider-dots-group">
                    <button type="button" class="auth-slider-dot-btn active" data-slide="0" title="Centralized ERP" aria-label="Slide 1"></button>
                    <button type="button" class="auth-slider-dot-btn" data-slide="1" title="Online Clearance" aria-label="Slide 2"></button>
                    <button type="button" class="auth-slider-dot-btn" data-slide="2" title="Security &amp; Compliance" aria-label="Slide 3"></button>
                </div>
                <button type="button" class="auth-slider-arrow-btn" id="heroNextBtn" title="Next Feature" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            <span>PANFILO M. MANGUERA SR. RD. &bull; 2026</span>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.auth-carousel-slide');
    const dots = document.querySelectorAll('.auth-slider-dot-btn');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');
    let currentSlide = 0;
    let autoSlideTimer = null;

    function showSlide(index) {
        if (!slides.length) return;
        currentSlide = (index + slides.length) % slides.length;
        slides.forEach((s, idx) => s.classList.toggle('active', idx === currentSlide));
        dots.forEach((d, idx) => d.classList.toggle('active', idx === currentSlide));
    }

    dots.forEach((dot) => {
        dot.addEventListener('click', function () {
            const idx = parseInt(this.getAttribute('data-slide'), 10);
            showSlide(idx);
            resetTimer();
        });
    });

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            showSlide(currentSlide - 1);
            resetTimer();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            showSlide(currentSlide + 1);
            resetTimer();
        });
    }

    function resetTimer() {
        if (autoSlideTimer) clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 7500);
    }

    const carouselArea = document.getElementById('authHeroCarousel');
    if (carouselArea) {
        carouselArea.addEventListener('mouseenter', () => clearInterval(autoSlideTimer));
        carouselArea.addEventListener('mouseleave', () => resetTimer());
    }

    resetTimer();
});
</script>

<?php
\Core\View::partial('scripts');
?>
