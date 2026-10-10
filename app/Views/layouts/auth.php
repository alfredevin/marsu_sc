<?php
\Core\View::partial('header', ['title' => $title ?? 'Login', 'bodyClass' => 'auth-page-body']);
?>

<style>
/* Google Font Typography Applied Universally to Auth Portal */
body.auth-page-body, .auth-split-layout {
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
}

.auth-hero-brand-title, .auth-hero-headline, .auth-portal-title, .auth-feature-title {
    font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif !important;
    letter-spacing: -0.02em;
}

/* Glassmorphism Card Deep Layering & Ambient Rim Glow */
.auth-glass-card {
    background: rgba(17, 21, 29, 0.94) !important;
    backdrop-filter: blur(28px) !important;
    -webkit-backdrop-filter: blur(28px) !important;
    border: 1px solid rgba(255, 255, 255, 0.09) !important;
    border-radius: 26px !important;
    padding: 2.25rem 2.25rem !important;
    box-shadow: 0 30px 80px -15px rgba(0, 0, 0, 0.85), 
                0 0 50px rgba(128, 0, 32, 0.22), 
                inset 0 1px 0 rgba(255, 255, 255, 0.12) !important;
    position: relative;
    overflow: visible;
}

/* Hero University Circular Logo (Clean, Perfectly Circular Emblem, No Outer Border/Box) */
.auth-hero-logo-badge {
    width: 60px !important;
    height: 60px !important;
    border-radius: 50% !important;
    background: transparent !important;
    background-color: transparent !important;
    border: none !important;
    box-shadow: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    flex-shrink: 0 !important;
    transition: transform 0.32s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    cursor: pointer;
}

.auth-hero-logo-badge:hover {
    transform: scale(1.1) rotate(4deg) !important;
}

.auth-hero-logo-img {
    width: 60px !important;
    height: 60px !important;
    border-radius: 50% !important;
    object-fit: contain !important;
    filter: drop-shadow(0 4px 14px rgba(0, 0, 0, 0.75)) !important;
    transition: filter 0.3s ease, transform 0.3s ease !important;
}

.auth-hero-logo-badge:hover .auth-hero-logo-img {
    filter: drop-shadow(0 0 16px rgba(212, 175, 55, 0.6)) drop-shadow(0 6px 18px rgba(0, 0, 0, 0.85)) !important;
}

/* Form Input Elevated Focus Styling */
.auth-input-container {
    position: relative;
    margin-bottom: 1.2rem;
}

.auth-field-input {
    background-color: #171c26 !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 14px !important;
    color: #ffffff !important;
    padding: 0.85rem 2.85rem 0.85rem 3rem !important;
    font-size: 0.92rem;
    font-weight: 500;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.auth-field-input:focus {
    background-color: #1c2230 !important;
    border-color: #ffd700 !important;
    box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.22) !important;
    outline: none;
}

.auth-field-icon {
    position: absolute;
    top: 50%;
    left: 1.15rem;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 1.15rem;
    pointer-events: none;
    z-index: 2;
    transition: color 0.25s ease;
}

.auth-input-container:focus-within .auth-field-icon {
    color: #ffd700;
}

/* Submit Button & Hover Sheen */
.btn-auth-portal {
    width: 100%;
    background: linear-gradient(135deg, #850021 0%, #580016 100%);
    border: 1px solid rgba(212, 175, 55, 0.4);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.92rem;
    letter-spacing: 1.2px;
    padding: 0.95rem 1.5rem;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(133, 0, 33, 0.5), 0 0 20px rgba(133, 0, 33, 0.3);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn-auth-portal:hover:not(:disabled) {
    background: linear-gradient(135deg, #a10028 0%, #6d001b 100%);
    border-color: rgba(255, 215, 0, 0.7);
    box-shadow: 0 12px 30px rgba(133, 0, 33, 0.7), 0 0 25px rgba(212, 175, 55, 0.35);
    transform: translateY(-2px);
    color: #ffffff;
}

.btn-auth-portal .transition-icon {
    transition: transform 0.25s ease;
}

.btn-auth-portal:hover .transition-icon {
    transform: translateX(4px);
}

/* Toast Notification Popover */
.auth-toast-feedback {
    position: absolute;
    top: -18px;
    left: 50%;
    transform: translateX(-50%) translateY(-10px);
    background: linear-gradient(135deg, #1e2430 0%, #151922 100%);
    border: 1px solid rgba(212, 175, 55, 0.6);
    color: #ffffff;
    padding: 8px 18px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6), 0 0 20px rgba(212, 175, 55, 0.25);
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 100;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.auth-toast-feedback.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
}

/* Module Select Dropdown */
.auth-module-select {
    width: 100%;
    background-color: #171c26 !important;
    border: 1px solid rgba(212, 175, 55, 0.35) !important;
    border-radius: 12px !important;
    color: #ffd700 !important;
    font-size: 0.8rem !important;
    font-weight: 600;
    padding: 0.7rem 1rem !important;
    transition: all 0.25s ease;
    cursor: pointer;
}

.auth-module-select:focus {
    border-color: #ffd700 !important;
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.25) !important;
    outline: none;
}

.auth-module-select option {
    background-color: #11141b;
    color: #ffffff;
    padding: 8px;
}
</style>

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
                                Seamless interoperability across Procurement (PMIS), Student Housing, Health Clinic, Guidance, Welfare, Assets, and Faculty Workload.
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
                            <i class="bi bi-briefcase-fill"></i>
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

        <!-- Bottom Line Track with Concentric Radar Beacon & University Labels -->
        <div class="auth-hero-footer-wrapper">
            <div class="auth-hero-track-container" id="heroTrackContainer" title="Click along the line to explore features">
                <div class="auth-hero-horizontal-line"></div>
                <!-- Interactive Stepping Hitboxes -->
                <div class="auth-track-step" data-slide="0" style="left: 25%;" title="Feature 1: Unified Access"></div>
                <div class="auth-track-step" data-slide="1" style="left: 55%;" title="Feature 2: Online Clearance"></div>
                <div class="auth-track-step" data-slide="2" style="left: 82%;" title="Feature 3: Compliance &amp; Security"></div>
                
                <!-- Glowing Concentric Radar Beacon (Glides smoothly along the line) -->
                <div class="auth-hero-radar-beacon" id="heroRadarBeacon" style="left: 25%;">
                    <div class="radar-outer-ring"></div>
                    <div class="radar-inner-ring"></div>
                    <div class="radar-center-dot"></div>
                </div>
            </div>

            <div class="auth-hero-footer-labels">
                <span class="auth-hero-footer-left"><i class="bi bi-building me-1 text-gold"></i>Marinduque State University &ndash; CICS System</span>
                <span class="auth-hero-footer-right"><i class="bi bi-geo-alt-fill me-1 text-gold"></i>SANTA CRUZ, MQE &bull; Portal 2026</span>
            </div>
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
    const beacon = document.getElementById('heroRadarBeacon');
    const steps = document.querySelectorAll('.auth-track-step');
    const positions = ['25%', '55%', '82%'];
    let currentSlide = 0;
    let autoSlideTimer = null;

    function showSlide(index) {
        if (!slides.length) return;
        currentSlide = (index + slides.length) % slides.length;
        slides.forEach((s, idx) => s.classList.toggle('active', idx === currentSlide));
        if (beacon && positions[currentSlide]) {
            beacon.style.left = positions[currentSlide];
        }
    }

    steps.forEach((step) => {
        step.addEventListener('click', function (e) {
            e.stopPropagation();
            const idx = parseInt(this.getAttribute('data-slide'), 10);
            showSlide(idx);
            resetTimer();
        });
    });

    if (beacon) {
        beacon.addEventListener('click', function (e) {
            e.stopPropagation();
            showSlide(currentSlide + 1);
            resetTimer();
        });
    }

    const track = document.getElementById('heroTrackContainer');
    if (track) {
        track.addEventListener('click', function (e) {
            const rect = track.getBoundingClientRect();
            const clickRatio = (e.clientX - rect.left) / rect.width;
            if (clickRatio < 0.35) showSlide(0);
            else if (clickRatio < 0.65) showSlide(1);
            else showSlide(2);
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
