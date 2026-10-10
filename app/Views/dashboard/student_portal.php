<?php
/**
 * MarSU Centralized ERP - Student Portal & Mobile App Interface
 * Modern, interactive, mobile-responsive client-side student application
 * Strict constraints: Zero database mutations, zero jQuery, pure vector icons, Google Fonts.
 */
\Core\View::partial('header', ['title' => 'MarSU Student App & Portal', 'bodyClass' => 'student-app-root']);
?>

<style>
/* ==========================================================================
   MARSU STUDENT MOBILE APP DESIGN SYSTEM & TOKENS
   ========================================================================== */
:root {
    --app-burgundy: #800020;
    --app-burgundy-dark: #580016;
    --app-gold: #d4af37;
    --app-gold-glow: rgba(212, 175, 55, 0.4);
    --app-surface: #0f131c;
    --app-surface-card: #171d2b;
    --app-surface-hover: #1f2738;
    --app-border: rgba(255, 255, 255, 0.08);
    --app-border-gold: rgba(212, 175, 55, 0.35);
}

body.student-app-root {
    background-color: #090c12 !important;
    color: #e2e8f0;
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif !important;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    min-height: 100vh;
}

/* Headings font */
.app-heading, .app-card-title, .app-section-title, .bottom-nav-label {
    font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif !important;
}

/* Simulator Container & Device Mockup Shell */
.app-viewport-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 1.5rem 1rem 3rem;
    transition: all 0.35s ease;
}

/* Phone Simulator Frame */
.phone-mockup-frame {
    width: 100%;
    max-width: 440px;
    background: #0f131c;
    border-radius: 44px;
    border: 8px solid #232a38;
    box-shadow: 0 25px 70px -10px rgba(0, 0, 0, 0.85), 
                0 0 35px rgba(128, 0, 32, 0.3),
                inset 0 0 0 2px rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
    min-height: 860px;
    display: flex;
    flex-direction: column;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Expanded Fullscreen Desktop Mode */
.app-viewport-wrapper.is-fullscreen .phone-mockup-frame {
    max-width: 960px;
    border-radius: 24px;
    border-width: 2px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
}

/* Real Mobile Screen Adaptation */
@media (max-width: 767.98px) {
    .app-viewport-wrapper {
        padding: 0 !important;
    }
    .phone-mockup-frame {
        max-width: 100% !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        min-height: 100vh !important;
    }
    .device-status-bar {
        border-radius: 0 !important;
    }
    .desktop-toolbar {
        display: none !important;
    }
}

/* Native Device Status Bar Simulation */
.device-status-bar {
    height: 38px;
    padding: 0 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.76rem;
    font-weight: 600;
    color: #cbd5e1;
    background: #0f131c;
    z-index: 1050;
    user-select: none;
}

.device-dynamic-island {
    width: 110px;
    height: 18px;
    background: #000000;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: inset 0 0 4px rgba(255, 255, 255, 0.15);
}

/* App Header Nav */
.app-top-header {
    background: rgba(17, 22, 32, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--app-border);
    padding: 0.85rem 1.25rem;
    position: sticky;
    top: 0;
    z-index: 1030;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.app-brand-lockup {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: inherit;
}

.app-brand-logo {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    object-fit: contain;
    filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.6));
}

.app-brand-name {
    font-size: 1.05rem;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.1;
}

.app-brand-badge {
    font-size: 0.64rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: var(--app-gold);
    text-transform: uppercase;
}

/* App Screens Container */
.app-screens-container {
    flex: 1;
    overflow-y: auto;
    padding: 1.25rem 1.25rem 6.5rem;
    scroll-behavior: smooth;
}

/* Screen View Panels (Only active one shown) */
.app-screen-view {
    display: none;
    animation: appFadeSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.app-screen-view.active-screen {
    display: block;
}

@keyframes appFadeSlideIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Student Profile Hero Card */
.student-hero-card {
    background: linear-gradient(135deg, rgba(128, 0, 32, 0.85) 0%, rgba(35, 14, 25, 0.95) 100%);
    border: 1px solid rgba(212, 175, 55, 0.4);
    border-radius: 20px;
    padding: 1.35rem;
    margin-bottom: 1.25rem;
    box-shadow: 0 12px 30px rgba(128, 0, 32, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.15);
    position: relative;
    overflow: hidden;
}

.student-hero-card::after {
    content: '';
    position: absolute;
    right: -25px;
    bottom: -25px;
    width: 140px;
    height: 140px;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
    pointer-events: none;
}

.student-avatar-wrap {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    border: 2px solid var(--app-gold);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    position: relative;
}

.student-avatar-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.student-online-pip {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    background-color: #10b981;
    border: 2px solid #1a1622;
    border-radius: 50%;
}

/* Quick Action Chips */
.quick-action-strip {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 4px;
    margin-bottom: 1.35rem;
    scrollbar-width: none;
}
.quick-action-strip::-webkit-scrollbar {
    display: none;
}

.btn-action-chip {
    background: var(--app-surface-card);
    border: 1px solid var(--app-border);
    color: #cbd5e1;
    font-size: 0.74rem;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    transition: all 0.2s ease;
    cursor: pointer;
    user-select: none;
}

.btn-action-chip:hover, .btn-action-chip:active {
    background: var(--app-surface-hover);
    border-color: var(--app-gold);
    color: #ffffff;
    transform: translateY(-1px);
}

/* Section Title */
.app-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.85rem;
}

.app-section-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: #ffffff;
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
}

.app-section-link {
    font-size: 0.72rem;
    color: var(--app-gold);
    text-decoration: none;
    font-weight: 600;
}

/* Services Category Tabs */
.service-cat-pills {
    display: flex;
    gap: 6px;
    overflow-x: auto;
    padding-bottom: 6px;
    margin-bottom: 1rem;
    scrollbar-width: none;
}
.service-cat-pills::-webkit-scrollbar {
    display: none;
}

.btn-cat-pill {
    background: var(--app-surface-card);
    border: 1px solid var(--app-border);
    color: #94a3b8;
    font-size: 0.72rem;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 20px;
    white-space: nowrap;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-cat-pill.active {
    background: linear-gradient(135deg, rgba(128, 0, 32, 0.7) 0%, rgba(212, 175, 55, 0.3) 100%);
    border-color: var(--app-gold);
    color: #ffd700;
    font-weight: 700;
}

/* Services Grid & Interactive Cards */
.services-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
    gap: 12px;
}

.service-item-card {
    background: var(--app-surface-card);
    border: 1px solid var(--app-border);
    border-radius: 16px;
    padding: 1rem;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
}

.service-item-card:hover {
    background: var(--app-surface-hover);
    border-color: var(--app-border-gold);
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.5), 0 0 15px rgba(212, 175, 55, 0.15);
}

.service-card-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
    transition: transform 0.25s ease;
}

.service-item-card:hover .service-card-icon {
    transform: scale(1.08);
}

.service-card-title {
    font-size: 0.84rem;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.25;
    margin-bottom: 4px;
}

.service-card-desc {
    font-size: 0.7rem;
    color: #94a3b8;
    line-height: 1.35;
    margin-bottom: 0.75rem;
}

.service-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.68rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    padding-top: 6px;
}

/* Floating Bottom Navigation Bar */
.student-bottom-nav {
    position: absolute;
    bottom: 12px;
    left: 12px;
    right: 12px;
    background: rgba(18, 23, 34, 0.95);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 28px;
    padding: 6px 10px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    z-index: 1040;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.75), 0 0 20px rgba(128, 0, 32, 0.2);
}

.bottom-nav-item {
    background: transparent;
    border: none;
    color: #94a3b8;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 3px;
    padding: 6px 12px;
    border-radius: 18px;
    cursor: pointer;
    transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    position: relative;
    user-select: none;
}

.bottom-nav-icon {
    font-size: 1.15rem;
    transition: transform 0.22s ease;
}

.bottom-nav-label {
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.2px;
}

.bottom-nav-item:hover {
    color: #ffffff;
}

.bottom-nav-item.active {
    color: #ffd700;
    background: rgba(212, 175, 55, 0.12);
}

.bottom-nav-item.active .bottom-nav-icon {
    transform: translateY(-2px);
    color: #ffd700;
}

.bottom-nav-badge-dot {
    position: absolute;
    top: 4px;
    right: 14px;
    width: 6px;
    height: 6px;
    background: #ef4444;
    border-radius: 50%;
}

/* Service Detail Bottom Sheet Drawer */
.service-drawer-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--app-border);
}

.drawer-drag-pill {
    width: 36px;
    height: 4px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    margin: 0 auto 12px;
}

/* Digital ID Card Styling */
.digital-id-card {
    background: linear-gradient(135deg, #800020 0%, #3b000f 100%);
    border: 2px solid var(--app-gold);
    border-radius: 18px;
    padding: 1.25rem;
    color: #ffffff;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
    position: relative;
    overflow: hidden;
}

/* Desktop Mode Toolbar Floating Badge */
.desktop-toolbar {
    position: fixed;
    top: 15px;
    right: 20px;
    z-index: 2000;
    display: flex;
    gap: 8px;
    align-items: center;
}
</style>

<!-- Floating Desktop Toolbar Controls -->
<div class="desktop-toolbar">
    <button type="button" class="btn btn-sm btn-dark border border-secondary shadow-sm rounded-pill px-3" id="toggleSimulatorBtn" title="Toggle between mobile device simulator and expanded screen">
        <i class="bi bi-phone me-1 text-gold"></i> <span id="toggleSimulatorText">Fullscreen View</span>
    </button>
    <a href="<?= url('dashboard') ?>" class="btn btn-sm btn-outline-light rounded-pill px-3 shadow-sm" title="Return to Core Admin ERP">
        <i class="bi bi-box-arrow-left me-1"></i> Admin ERP
    </a>
</div>

<!-- Main App Viewport Container -->
<div class="app-viewport-wrapper" id="appViewportWrapper">
    <!-- Smartphone Bezel Shell -->
    <div class="phone-mockup-frame" id="phoneFrame">
        <!-- 1. Simulated Native Mobile Status Bar -->
        <div class="device-status-bar">
            <span id="deviceClockTime">9:41</span>
            <div class="device-dynamic-island">
                <i class="bi bi-shield-check text-gold" style="font-size: 0.65rem;"></i>
                <span style="font-size: 0.6rem; color: #cbd5e1;">MarSU ID</span>
            </div>
            <div class="d-flex align-items-center gap-1">
                <i class="bi bi-reception-4" style="font-size: 0.7rem;"></i>
                <i class="bi bi-wifi" style="font-size: 0.7rem;"></i>
                <i class="bi bi-battery-full text-success" style="font-size: 0.85rem;"></i>
            </div>
        </div>

        <!-- 2. Mobile App Header Bar -->
        <header class="app-top-header">
            <div class="app-brand-lockup">
                <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Seal" class="app-brand-logo">
                <div>
                    <div class="app-brand-name">MarSU Student</div>
                    <div class="app-brand-badge">Official Portal &bull; AY 26-27</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm p-1 text-white-50 hover-text-white" onclick="switchAppTab('alerts')" title="Campus Notifications">
                    <span class="position-relative d-inline-block">
                        <i class="bi bi-bell-fill text-white fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.55rem; padding: 2px 4px;">3</span>
                    </span>
                </button>
                <button type="button" class="btn btn-sm p-1 text-white-50 hover-text-white" onclick="switchAppTab('profile')" title="Student Profile">
                    <img src="<?= !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg') ?>" 
                         alt="User" width="30" height="30" class="rounded-circle border border-warning" style="object-fit: cover;">
                </button>
            </div>
        </header>

        <!-- 3. Screen Views Container -->
        <main class="app-screens-container" id="appScreensContainer">
            
            <!-- ===================================================================
                 SCREEN 1: HOME DASHBOARD FEED
                 =================================================================== -->
            <section class="app-screen-view active-screen" id="screenHome">
                <!-- Student Greeting & Digital Profile Hero Card -->
                <div class="student-hero-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="student-avatar-wrap">
                                <img src="<?= !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg') ?>" 
                                     alt="Student Avatar" class="student-avatar-img">
                                <span class="student-online-pip"></span>
                            </div>
                            <div>
                                <div class="text-white-50 small" style="font-size: 0.72rem;">Welcome back,</div>
                                <h3 class="mb-0 fw-bold text-white fs-6"><?= e(($student['first_name'] ?? 'Maria') . ' ' . ($student['last_name'] ?? 'Santos')) ?></h3>
                                <div class="text-warning small fw-semibold" style="font-size: 0.74rem;">
                                    <i class="bi bi-person-vcard me-1"></i><?= e($student['student_number'] ?? '26S0227') ?> &bull; <?= e($student['program_code'] ?? 'BSIS') ?> 3-A
                                </div>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50" style="font-size: 0.65rem;">
                            <i class="bi bi-check-circle-fill me-1"></i>Enrolled
                        </span>
                    </div>

                    <!-- Live Clearance Telemetry Gauge Bar -->
                    <div class="mt-3 pt-2 border-top border-white border-opacity-10">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-white-50 small" style="font-size: 0.72rem;">Online Semester Clearance</span>
                            <span class="text-gold fw-bold small" style="font-size: 0.72rem;">8 / 10 Stations (80%)</span>
                        </div>
                        <div class="progress" style="height: 6px; background-color: rgba(0, 0, 0, 0.4);">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-warning w-100 rounded-pill py-1 font-weight-bold" onclick="openDigitalIdModal()" style="font-size: 0.72rem;">
                            <i class="bi bi-qr-code-scan me-1"></i> Digital Student ID Pass
                        </button>
                    </div>
                </div>

                <!-- Quick Action Shortcut Chips -->
                <div class="quick-action-strip">
                    <button type="button" class="btn-action-chip" onclick="switchAppTab('services')">
                        <i class="bi bi-grid-fill text-gold"></i> All Services
                    </button>
                    <button type="button" class="btn-action-chip" onclick="switchAppTab('clearance')">
                        <i class="bi bi-shield-check text-success"></i> My Clearance
                    </button>
                    <button type="button" class="btn-action-chip" onclick="triggerServiceDrawer('health')">
                        <i class="bi bi-heart-pulse-fill text-danger"></i> Clinic Booking
                    </button>
                    <button type="button" class="btn-action-chip" onclick="triggerServiceDrawer('housing')">
                        <i class="bi bi-house-door-fill text-info"></i> Dorm Space
                    </button>
                    <button type="button" class="btn-action-chip" onclick="triggerServiceDrawer('procurement')">
                        <i class="bi bi-box-seam-fill text-primary"></i> Lab Supplies
                    </button>
                </div>

                <!-- Important University Announcements -->
                <div class="app-section-header">
                    <h4 class="app-section-title"><i class="bi bi-megaphone-fill text-gold"></i> Campus Bulletin</h4>
                    <span class="text-white-50 small" style="font-size: 0.7rem;">Live Feed</span>
                </div>
                <div class="mb-3">
                    <div class="p-3 rounded-3 mb-2" style="background: rgba(23, 29, 43, 0.9); border: 1px solid rgba(255, 255, 255, 0.08);">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-25" style="font-size: 0.65rem;">Priority Advisory</span>
                            <span class="text-white-50" style="font-size: 0.68rem;"><i class="bi bi-clock me-1"></i>Today, 8:00 AM</span>
                        </div>
                        <div class="fw-bold text-white small mb-1">Final Midterm Clearance Sign-offs Now Open</div>
                        <p class="text-white-50 small mb-0" style="font-size: 0.72rem; line-height: 1.35;">
                            All CICS students may now submit department clearance sign-offs via the Clearance tab. Ensure library fines and clinic dental checks are settled.
                        </p>
                    </div>
                    <div class="p-3 rounded-3" style="background: rgba(23, 29, 43, 0.9); border: 1px solid rgba(255, 255, 255, 0.08);">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="badge bg-warning bg-opacity-25 text-gold border border-warning border-opacity-25" style="font-size: 0.65rem;">Procurement Advisory</span>
                            <span class="text-white-50" style="font-size: 0.68rem;"><i class="bi bi-clock me-1"></i>Yesterday</span>
                        </div>
                        <div class="fw-bold text-white small mb-1">CICS Hardware Lab Component Requisition Open</div>
                        <p class="text-white-50 small mb-0" style="font-size: 0.72rem; line-height: 1.35;">
                            Capstones and Thesis teams can now file lab hardware supply requests via the new Procurement Management module in Services.
                        </p>
                    </div>
                </div>

                <!-- Today's Schedule Card -->
                <div class="app-section-header">
                    <h4 class="app-section-title"><i class="bi bi-calendar-check-fill text-info"></i> Today's Class Schedule</h4>
                    <span class="text-white-50 small" style="font-size: 0.7rem;">Mon, Oct 10</span>
                </div>
                <div class="p-3 rounded-3 mb-3" style="background: rgba(23, 29, 43, 0.9); border: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="d-flex align-items-center justify-content-between pb-2 mb-2 border-bottom border-white border-opacity-10">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3 bg-primary bg-opacity-25 text-primary">
                                <i class="bi bi-code-square fs-6"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-white small">IS 311: Enterprise Architecture</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Room 204 &bull; CICS Main Building</span>
                            </div>
                        </div>
                        <span class="badge bg-secondary bg-opacity-25 text-light" style="font-size: 0.68rem;">09:00 - 11:30 AM</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3 bg-success bg-opacity-25 text-success">
                                <i class="bi bi-database-fill-check fs-6"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-white small">IS 314: Business Process Re-engineering</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Computer Lab 2 &bull; Prof. Morales</span>
                            </div>
                        </div>
                        <span class="badge bg-secondary bg-opacity-25 text-light" style="font-size: 0.68rem;">01:30 - 04:30 PM</span>
                    </div>
                </div>
            </section>

            <!-- ===================================================================
                 SCREEN 2: UNIVERSITY SERVICES SELECTOR
                 =================================================================== -->
            <section class="app-screen-view" id="screenServices">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h3 class="app-heading mb-0 text-white fs-5 fw-bold">Campus Services</h3>
                        <span class="badge bg-secondary bg-opacity-25 text-gold border border-secondary border-opacity-25" style="font-size: 0.68rem;">11 Integrated Modules</span>
                    </div>
                    <p class="text-white-50 small mb-2" style="font-size: 0.74rem;">
                        Select any student service to file requisitions, book consultations, or apply online.
                    </p>

                    <!-- Real-time Interactive Search Filter -->
                    <div class="position-relative mb-2">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-white-50" style="font-size: 0.8rem;"></i>
                        <input type="text" id="serviceSearchInput" class="form-control form-control-sm ps-5 text-white" 
                               placeholder="Search services (e.g. procurement, clinic, dorm, scholarship)..." 
                               style="background: #171d2b; border: 1px solid rgba(255,255,255,0.12); border-radius: 12px; font-size: 0.8rem; padding-top: 0.55rem; padding-bottom: 0.55rem;">
                    </div>

                    <!-- Category Filter Tabs -->
                    <div class="service-cat-pills" id="categoryPillContainer">
                        <button type="button" class="btn-cat-pill active" onclick="filterServices('all', this)">All (11)</button>
                        <button type="button" class="btn-cat-pill" onclick="filterServices('operations', this)">Operations &amp; Tech</button>
                        <button type="button" class="btn-cat-pill" onclick="filterServices('welfare', this)">Living &amp; Aid</button>
                        <button type="button" class="btn-cat-pill" onclick="filterServices('health', this)">Health &amp; Wellness</button>
                        <button type="button" class="btn-cat-pill" onclick="filterServices('academic', this)">Academic &amp; Research</button>
                    </div>
                </div>

                <!-- 11 Sub-Module Service Cards Grid -->
                <div class="services-card-grid" id="servicesGrid">
                    
                    <!-- 1. Procurement & Supplies Requisitions -->
                    <div class="service-item-card" data-category="operations" data-service-id="procurement" onclick="triggerServiceDrawer('procurement')">
                        <div>
                            <div class="service-card-icon bg-primary bg-opacity-25 text-primary">
                                <i class="bi bi-box-seam-fill"></i>
                            </div>
                            <div class="service-card-title">Procurement &amp; Supplies</div>
                            <div class="service-card-desc">Request lab hardware, thesis project materials canvass &amp; supplies.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Apply</span>
                            <span class="text-white-50">prc_</span>
                        </div>
                    </div>

                    <!-- 2. Housing & Dormitory Management -->
                    <div class="service-item-card" data-category="welfare" data-service-id="housing" onclick="triggerServiceDrawer('housing')">
                        <div>
                            <div class="service-card-icon bg-info bg-opacity-25 text-info">
                                <i class="bi bi-house-door-fill"></i>
                            </div>
                            <div class="service-card-title">Housing &amp; Dorm Directory</div>
                            <div class="service-card-desc">Accredited student boarding houses, bed reservations &amp; landlord checks.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Apply</span>
                            <span class="text-white-50">hsg_</span>
                        </div>
                    </div>

                    <!-- 3. Medical & Dental Consultation Clinic -->
                    <div class="service-item-card" data-category="health" data-service-id="health" onclick="triggerServiceDrawer('health')">
                        <div>
                            <div class="service-card-icon bg-danger bg-opacity-25 text-danger">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <div class="service-card-title">Medical &amp; Dental Clinic</div>
                            <div class="service-card-desc">Doctor appointments, dental checkups, and medical clearance certificates.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Apply</span>
                            <span class="text-white-50">hth_</span>
                        </div>
                    </div>

                    <!-- 4. Guidance & Counseling Records -->
                    <div class="service-item-card" data-category="health" data-service-id="guidance" onclick="triggerServiceDrawer('guidance')">
                        <div>
                            <div class="service-card-icon bg-warning bg-opacity-25 text-warning">
                                <i class="bi bi-chat-heart-fill"></i>
                            </div>
                            <div class="service-card-title">Guidance &amp; Counseling</div>
                            <div class="service-card-desc">Confidential mental wellness session, exit interviews, and peer advising.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Apply</span>
                            <span class="text-white-50">gdc_</span>
                        </div>
                    </div>

                    <!-- 5. Student Welfare Services -->
                    <div class="service-item-card" data-category="welfare" data-service-id="welfare" onclick="triggerServiceDrawer('welfare')">
                        <div>
                            <div class="service-card-icon bg-success bg-opacity-25 text-success">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div class="service-card-title">Welfare &amp; Scholarships</div>
                            <div class="service-card-desc">Apply for CHED TES financial aid, student grants &amp; emergency support.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Apply</span>
                            <span class="text-white-50">wlf_</span>
                        </div>
                    </div>

                    <!-- 6. 4Ps Beneficiary Expense Monitoring -->
                    <div class="service-item-card" data-category="welfare" data-service-id="expense4ps" onclick="triggerServiceDrawer('expense4ps')">
                        <div>
                            <div class="service-card-icon bg-info bg-opacity-25 text-info">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="service-card-title">4Ps Allowance Tracker</div>
                            <div class="service-card-desc">Pantawid Pamilya student stipend monitoring &amp; liquidation logs.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Apply</span>
                            <span class="text-white-50">exp_</span>
                        </div>
                    </div>

                    <!-- 7. IT Equipment & Asset Borrowing -->
                    <div class="service-item-card" data-category="operations" data-service-id="assets" onclick="triggerServiceDrawer('assets')">
                        <div>
                            <div class="service-card-icon bg-primary bg-opacity-25 text-primary">
                                <i class="bi bi-laptop-fill"></i>
                            </div>
                            <div class="service-card-title">IT Equipment Borrowing</div>
                            <div class="service-card-desc">Borrow laptops, projectors, and scientific hardware for coursework.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Apply</span>
                            <span class="text-white-50">ast_</span>
                        </div>
                    </div>

                    <!-- 8. Institutional Repository & Research KMS -->
                    <div class="service-item-card" data-category="academic" data-service-id="irimkms" onclick="triggerServiceDrawer('irimkms')">
                        <div>
                            <div class="service-card-icon bg-secondary bg-opacity-25 text-light">
                                <i class="bi bi-journal-richtext"></i>
                            </div>
                            <div class="service-card-title">Research &amp; KMS Repository</div>
                            <div class="service-card-desc">Browse published academic journals, university theses &amp; capstone papers.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Browse</span>
                            <span class="text-white-50">kmp_</span>
                        </div>
                    </div>

                    <!-- 9. Student Organizations & Dues -->
                    <div class="service-item-card" data-category="welfare" data-service-id="orgfinance" onclick="triggerServiceDrawer('orgfinance')">
                        <div>
                            <div class="service-card-icon bg-warning bg-opacity-25 text-gold">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <div class="service-card-title">Student Org Finances</div>
                            <div class="service-card-desc">Pay club membership fees, track event dues &amp; view digital receipts.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>View</span>
                            <span class="text-white-50">orf_</span>
                        </div>
                    </div>

                    <!-- 10. Student Leadership & SSC Elections -->
                    <div class="service-item-card" data-category="welfare" data-service-id="orgleadership" onclick="triggerServiceDrawer('orgleadership')">
                        <div>
                            <div class="service-card-icon bg-danger bg-opacity-25 text-danger">
                                <i class="bi bi-person-lines-fill"></i>
                            </div>
                            <div class="service-card-title">Student Leadership &amp; SSC</div>
                            <div class="service-card-desc">Supreme Student Council officers directory, candidate filings &amp; voting.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Directory</span>
                            <span class="text-white-50">sld_</span>
                        </div>
                    </div>

                    <!-- 11. Student Retention & Academic Standing -->
                    <div class="service-item-card" data-category="academic" data-service-id="retention" onclick="triggerServiceDrawer('retention')">
                        <div>
                            <div class="service-card-icon bg-success bg-opacity-25 text-success">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <div class="service-card-title">Retention &amp; Academic Risk</div>
                            <div class="service-card-desc">View grade trajectory forecasts, cohort standing &amp; advising alerts.</div>
                        </div>
                        <div class="service-card-footer">
                            <span class="text-gold fw-bold"><i class="bi bi-lightning-charge me-1"></i>Forecast</span>
                            <span class="text-white-50">ret_</span>
                        </div>
                    </div>

                </div>
            </section>

            <!-- ===================================================================
                 SCREEN 3: CLEARANCE TRACKER
                 =================================================================== -->
            <section class="app-screen-view" id="screenClearance">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="app-heading mb-0 text-white fs-5 fw-bold">Online Clearance</h3>
                    <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50" style="font-size: 0.68rem;">AY 2026-2027 1st Sem</span>
                </div>
                <p class="text-white-50 small mb-3" style="font-size: 0.74rem;">
                    Real-time status of your end-of-semester administrative clearance requirements.
                </p>

                <!-- Clearance Progress Card -->
                <div class="p-3 rounded-3 mb-3" style="background: linear-gradient(135deg, #171e2e 0%, #101520 100%); border: 1px solid rgba(212, 175, 55, 0.35);">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="fw-bold text-white small">Overall Clearance Progress</div>
                            <div class="text-white-50" style="font-size: 0.7rem;">8 of 10 Required Sign-Offs Completed</div>
                        </div>
                        <span class="fs-4 fw-extrabold text-gold">80%</span>
                    </div>
                    <div class="progress" style="height: 8px; background: rgba(0,0,0,0.4);">
                        <div class="progress-bar bg-warning" style="width: 80%;"></div>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-warning w-100 rounded-pill py-1" onclick="simulateClearanceDownload()">
                            <i class="bi bi-download me-1"></i> Preview Clearance Form
                        </button>
                    </div>
                </div>

                <!-- 10 Clearance Stations Checklist -->
                <div class="app-section-header">
                    <h4 class="app-section-title"><i class="bi bi-check2-all text-gold"></i> Validation Stations</h4>
                </div>
                <div class="d-flex flex-column gap-2 mb-3">
                    
                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">1. University Registrar</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Credentials Verified</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">2. University Library</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Zero Overdue Books</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">3. Cashier &amp; Accounting</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Zero Balance Account</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">4. Medical &amp; Dental Clinic</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Health Record Updated</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">5. Guidance &amp; Counseling</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Counseling Exit Passed</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">6. Department Chairperson</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Academic Units Checked</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">7. Student Welfare Services</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">TES Grantee File OK</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(255, 255, 255, 0.05);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">8. Student Council (SSC)</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Council Dues Cleared</span>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 0.65rem;">SIGNED</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(234, 179, 8, 0.3);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history text-warning fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">9. Property &amp; Lab Custodian</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Pending Lab Return</span>
                            </div>
                        </div>
                        <span class="badge bg-warning bg-opacity-25 text-warning" style="font-size: 0.65rem;">PENDING</span>
                    </div>

                    <div class="p-2 px-3 rounded-3 d-flex justify-content-between align-items-center" style="background: rgba(23, 29, 43, 0.7); border: 1px solid rgba(234, 179, 8, 0.3);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history text-warning fs-5"></i>
                            <div>
                                <div class="text-white small fw-bold">10. College Dean's Office</div>
                                <span class="text-white-50" style="font-size: 0.68rem;">Final Approval</span>
                            </div>
                        </div>
                        <span class="badge bg-warning bg-opacity-25 text-warning" style="font-size: 0.65rem;">PENDING</span>
                    </div>

                </div>
            </section>

            <!-- ===================================================================
                 SCREEN 4: ALERTS & NOTIFICATIONS
                 =================================================================== -->
            <section class="app-screen-view" id="screenAlerts">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="app-heading mb-0 text-white fs-5 fw-bold">Notifications</h3>
                    <button type="button" class="btn btn-link btn-sm text-gold p-0 text-decoration-none" onclick="markAllNotificationsRead()" style="font-size: 0.72rem;">
                        Mark all as read
                    </button>
                </div>
                <p class="text-white-50 small mb-3" style="font-size: 0.74rem;">
                    System updates, clearances, and module notifications.
                </p>

                <div class="d-flex flex-column gap-2 mb-3">
                    <div class="p-3 rounded-3" style="background: rgba(23, 29, 43, 0.95); border: 1px solid rgba(212, 175, 55, 0.35);">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <span class="badge bg-primary bg-opacity-25 text-primary" style="font-size: 0.65rem;">Procurement PMIS</span>
                            <span class="text-white-50" style="font-size: 0.68rem;">10m ago</span>
                        </div>
                        <div class="fw-bold text-white small">Material Requisition Approved</div>
                        <p class="text-white-50 small mb-0" style="font-size: 0.72rem;">
                            Your lab supply requisition for <code class="text-gold">PR-2026-089</code> has been reviewed by the BAC and ready for distribution at the Dean's Office.
                        </p>
                    </div>

                    <div class="p-3 rounded-3" style="background: rgba(23, 29, 43, 0.95); border: 1px solid rgba(255, 255, 255, 0.08);">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <span class="badge bg-danger bg-opacity-25 text-danger" style="font-size: 0.65rem;">Clinic &amp; Health</span>
                            <span class="text-white-50" style="font-size: 0.68rem;">2h ago</span>
                        </div>
                        <div class="fw-bold text-white small">Clinic Clearance Verified</div>
                        <p class="text-white-50 small mb-0" style="font-size: 0.72rem;">
                            Campus physician Dr. Arnel completed your medical assessment. Clinic clearance sign-off is automatically approved.
                        </p>
                    </div>

                    <div class="p-3 rounded-3" style="background: rgba(23, 29, 43, 0.95); border: 1px solid rgba(255, 255, 255, 0.08);">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <span class="badge bg-info bg-opacity-25 text-info" style="font-size: 0.65rem;">Housing Directory</span>
                            <span class="text-white-50" style="font-size: 0.68rem;">1d ago</span>
                        </div>
                        <div class="fw-bold text-white small">Dormitory Bed Allocation Confirmed</div>
                        <p class="text-white-50 small mb-0" style="font-size: 0.72rem;">
                            Your application for Santa Cruz Campus Dorm B (Bed 204-A) has been marked active by the Housing Administrator.
                        </p>
                    </div>
                </div>
            </section>

            <!-- ===================================================================
                 SCREEN 5: STUDENT PROFILE & DIGITAL ID
                 =================================================================== -->
            <section class="app-screen-view" id="screenProfile">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="app-heading mb-0 text-white fs-5 fw-bold">Student Profile</h3>
                    <span class="badge bg-secondary bg-opacity-25 text-gold border border-secondary border-opacity-25" style="font-size: 0.68rem;">Verified Student</span>
                </div>

                <!-- Digital ID Card Preview -->
                <div class="digital-id-card mb-3" id="digitalIdCard">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU" width="34" height="34" style="object-fit: contain;">
                            <div>
                                <div class="text-uppercase fw-extrabold text-white" style="font-size: 0.74rem; letter-spacing: 0.5px;">MARINDUQUE STATE UNIVERSITY</div>
                                <div class="text-warning text-uppercase" style="font-size: 0.58rem; letter-spacing: 1px;">College of Information &amp; Computing Sciences</div>
                            </div>
                        </div>
                        <span class="badge bg-warning text-dark font-weight-bold" style="font-size: 0.62rem;">AY 26-27</span>
                    </div>

                    <div class="d-flex gap-3 align-items-center mb-3">
                        <img src="<?= !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg') ?>" 
                             alt="Student" width="64" height="64" class="rounded-3 border border-2 border-warning" style="object-fit: cover;">
                        <div>
                            <h4 class="mb-0 fw-bold text-white fs-6"><?= e(($student['first_name'] ?? 'Maria') . ' ' . ($student['last_name'] ?? 'Santos')) ?></h4>
                            <div class="text-warning small fw-bold"><?= e($student['program_code'] ?? 'BSIS') ?> &bull; 3rd Year</div>
                            <div class="text-white-50 small" style="font-size: 0.7rem;">ID: <code class="text-white fw-bold"><?= e($student['student_number'] ?? '26S0227') ?></code></div>
                        </div>
                    </div>

                    <div class="p-2 rounded-2 bg-black bg-opacity-40 d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-50" style="font-size: 0.58rem;">CAMPUS BARCODE IDENTIFIER</div>
                            <code class="text-warning fw-bold" style="font-size: 0.72rem;">*MARSU-26S0227-CICS*</code>
                        </div>
                        <i class="bi bi-qr-code text-gold fs-4"></i>
                    </div>
                </div>

                <!-- Account Settings & Information List -->
                <div class="p-3 rounded-3 mb-3" style="background: rgba(23, 29, 43, 0.9); border: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="fw-bold text-white small mb-2 border-bottom border-white border-opacity-10 pb-2">Academic Information</div>
                    <div class="d-flex justify-content-between py-1 small"><span class="text-white-50">Program:</span> <span class="text-white fw-semibold">BS Information Systems</span></div>
                    <div class="d-flex justify-content-between py-1 small"><span class="text-white-50">Campus:</span> <span class="text-white fw-semibold">Santa Cruz Main Campus</span></div>
                    <div class="d-flex justify-content-between py-1 small"><span class="text-white-50">Year &amp; Section:</span> <span class="text-white fw-semibold">Year 3 &bull; Section A</span></div>
                    <div class="d-flex justify-content-between py-1 small"><span class="text-white-50">Student Email:</span> <span class="text-white fw-semibold"><?= e($student['email'] ?? 'student@marsu.edu.ph') ?></span></div>
                </div>

                <!-- Session Sign Out Button -->
                <div class="d-flex flex-column gap-2 mb-3">
                    <a href="<?= url('dashboard') ?>" class="btn btn-outline-warning w-100 rounded-pill py-2 text-decoration-none fw-semibold" style="font-size: 0.8rem;">
                        <i class="bi bi-speedometer2 me-1"></i> Open Admin Core ERP Dashboard
                    </a>
                    <form method="POST" action="<?= url('logout') ?>">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill py-2 fw-semibold" style="font-size: 0.8rem;">
                            <i class="bi bi-box-arrow-right me-1"></i> Sign Out from Student App
                        </button>
                    </form>
                </div>
            </section>

        </main>

        <!-- 4. Floating Mobile Bottom Navigation Bar (The requested Bottom Navbar) -->
        <nav class="student-bottom-nav" id="studentBottomNav">
            <button type="button" class="bottom-nav-item active" data-tab="home" onclick="switchAppTab('home', this)">
                <i class="bi bi-house-door-fill bottom-nav-icon"></i>
                <span class="bottom-nav-label">Home</span>
            </button>
            <button type="button" class="bottom-nav-item" data-tab="services" onclick="switchAppTab('services', this)">
                <i class="bi bi-grid-3x3-gap-fill bottom-nav-icon"></i>
                <span class="bottom-nav-label">Services</span>
            </button>
            <button type="button" class="bottom-nav-item" data-tab="clearance" onclick="switchAppTab('clearance', this)">
                <i class="bi bi-shield-check bottom-nav-icon"></i>
                <span class="bottom-nav-label">Clearance</span>
            </button>
            <button type="button" class="bottom-nav-item" data-tab="alerts" onclick="switchAppTab('alerts', this)">
                <i class="bi bi-bell-fill bottom-nav-icon"></i>
                <span class="bottom-nav-badge-dot"></span>
                <span class="bottom-nav-label">Alerts</span>
            </button>
            <button type="button" class="bottom-nav-item" data-tab="profile" onclick="switchAppTab('profile', this)">
                <i class="bi bi-person-circle bottom-nav-icon"></i>
                <span class="bottom-nav-label">Profile</span>
            </button>
        </nav>

    </div>
</div>

<!-- =======================================================================
     OFFCANVAS: INTERACTIVE SERVICE REQUEST BOTTOM SHEET DRAWER
     ======================================================================= -->
<div class="offcanvas offcanvas-bottom text-white" tabindex="-1" id="serviceRequestDrawer" 
     style="background: #111622; border-top: 2px solid var(--app-gold); height: 75vh; border-radius: 26px 26px 0 0;" 
     aria-labelledby="serviceDrawerTitle">
    <div class="offcanvas-header border-bottom border-white border-opacity-10 py-3">
        <div class="d-flex align-items-center gap-3">
            <div id="drawerIconBadge" class="p-2 rounded-3 bg-warning bg-opacity-25 text-gold fs-4">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <div>
                <h5 class="offcanvas-title fw-bold text-white mb-0 fs-6" id="serviceDrawerTitle">Service Name</h5>
                <span class="text-white-50 small" id="serviceDrawerSub" style="font-size: 0.72rem;">Module Scope</span>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
        <div class="drawer-drag-pill"></div>
        
        <p class="text-white-50 small mb-3" id="serviceDrawerDesc" style="font-size: 0.78rem;">
            Detailed description of service requirements.
        </p>

        <!-- Requirements & SLA pill -->
        <div class="d-flex justify-content-between align-items-center p-2 px-3 rounded-3 mb-3" style="background: rgba(23, 29, 43, 0.8); border: 1px solid rgba(255,255,255,0.08);">
            <div class="small text-white-50" style="font-size: 0.72rem;">Turnaround Time (SLA)</div>
            <div class="badge bg-warning bg-opacity-25 text-gold" id="serviceDrawerSla">1 - 2 Business Days</div>
        </div>

        <!-- Interactive Client-side Request Form (Design only, zero DB writes) -->
        <form id="serviceClientForm" onsubmit="handleServiceFormSubmit(event)">
            <input type="hidden" id="serviceDrawerInputKey" value="">

            <div class="mb-3">
                <label class="form-label text-white-50 small mb-1" style="font-size: 0.74rem;">REQUEST PURPOSE / DESCRIPTION</label>
                <input type="text" class="form-control form-control-sm text-white" id="servicePurposeInput" 
                       placeholder="e.g. For Capstone Project / Course Requirement" 
                       style="background: #171d2b; border: 1px solid rgba(255,255,255,0.15);" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-white-50 small mb-1" style="font-size: 0.74rem;">URGENCY LEVEL</label>
                <select class="form-select form-select-sm text-white" id="serviceUrgencySelect" style="background: #171d2b; border: 1px solid rgba(255,255,255,0.15);">
                    <option value="Normal">Normal Processing (Standard)</option>
                    <option value="Priority">Priority / Academic Deadline</option>
                    <option value="Urgent">Emergency / Medical / Urgent</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label text-white-50 small mb-1" style="font-size: 0.74rem;">ADDITIONAL NOTES / ATTACHMENT DETAILS</label>
                <textarea class="form-control form-control-sm text-white" id="serviceNotesInput" rows="2" 
                          placeholder="Provide any additional specifications, contact details, or notes..." 
                          style="background: #171d2b; border: 1px solid rgba(255,255,255,0.15);"></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary btn-sm w-50 rounded-pill" data-bs-dismiss="offcanvas">Cancel</button>
                <button type="submit" class="btn btn-warning btn-sm w-50 rounded-pill fw-bold" id="submitServiceBtn">
                    <i class="bi bi-send-fill me-1"></i> Submit Request
                </button>
            </div>
        </form>
    </div>
</div>

<!-- =======================================================================
     MODAL: DIGITAL STUDENT ID FLIP PREVIEW
     ======================================================================= -->
<div class="modal fade" id="digitalIdModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-white" style="background: #121722; border: 2px solid var(--app-gold); border-radius: 22px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-6 fw-bold text-gold"><i class="bi bi-qr-code me-2"></i>Official Digital Campus ID</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="p-3 rounded-3 bg-white d-inline-block shadow-lg mb-3">
                    <!-- SVG simulated QR code -->
                    <i class="bi bi-qr-code text-dark" style="font-size: 8rem;"></i>
                </div>
                <h5 class="text-white fw-bold mb-1"><?= e(($student['first_name'] ?? 'Maria') . ' ' . ($student['last_name'] ?? 'Santos')) ?></h5>
                <div class="text-warning small mb-2"><?= e($student['student_number'] ?? '26S0227') ?> &bull; <?= e($student['program_code'] ?? 'BSIS') ?></div>
                <p class="text-white-50 small mb-0" style="font-size: 0.72rem;">
                    Valid for Academic Year 2026-2027. Scan at CICS turnstiles, university library, and campus security posts.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-warning btn-sm w-100 rounded-pill" data-bs-dismiss="modal">Close ID Pass</button>
            </div>
        </div>
    </div>
</div>

<!-- =======================================================================
     INTERACTIVE JAVASCRIPT LOGIC (Zero jQuery, Pure Vanilla ES6)
     ======================================================================= -->
<script>
// Service Metadata Dictionary (11 System Sub-modules)
const SYSTEM_SERVICES = {
    procurement: {
        title: "Procurement & Supplies Management",
        sub: "Group 1 • Campus Operations (prc_)",
        icon: "bi-box-seam-fill",
        color: "primary",
        sla: "24 - 48 Hours",
        desc: "Request laboratory electronic components, capstone supplies, and verify canvass availability for academic research needs."
    },
    housing: {
        title: "Boarding House & Dormitory Directory",
        sub: "Group 7 • Student Living (hsg_)",
        icon: "bi-house-door-fill",
        color: "info",
        sla: "Instant / 1 Day",
        desc: "Browse accredited boarding house vacancies, campus dorm bed reservations, and landlord accreditation certifications."
    },
    health: {
        title: "Medical & Dental Consultation Clinic",
        sub: "Group 4 • Health Services (hth_)",
        icon: "bi-heart-pulse-fill",
        color: "danger",
        sla: "Same-Day Booking",
        desc: "Schedule confidential physical examinations, routine dental checks, and request digital medical certificates."
    },
    guidance: {
        title: "Guidance & Psychological Counseling",
        sub: "Group 11 • Student Guidance (gdc_)",
        icon: "bi-chat-heart-fill",
        color: "warning",
        sla: "Confidential / 1 Day",
        desc: "Private counseling sessions, mental health wellness appointments, student peer advising, and clearance exit interviews."
    },
    welfare: {
        title: "Student Welfare & CHED Scholarships",
        sub: "Group 10 • Welfare & Aid (wlf_)",
        icon: "bi-award-fill",
        color: "success",
        sla: "3 - 5 Business Days",
        desc: "Apply for Tertiary Education Subsidy (TES), CHED scholarship validations, and student emergency financial grants."
    },
    expense4ps: {
        title: "4Ps Beneficiary Expense Monitoring",
        sub: "Group 1 • Social Assistance (exp_)",
        icon: "bi-cash-stack",
        color: "info",
        sla: "Monthly Evaluation",
        desc: "Track educational stipend disbursements, monitor allowance liquidation logs, and submit official academic expense receipts."
    },
    assets: {
        title: "IT Equipment & Campus Asset Borrowing",
        sub: "Group 9 • Assets & Inventory (ast_)",
        icon: "bi-laptop-fill",
        color: "primary",
        sla: "2 - 4 Hours SLA",
        desc: "Reserve and borrow CICS laboratory laptops, projectors, scientific microcontrollers, and process asset clearance returns."
    },
    irimkms: {
        title: "Research Repository & Institutional KMS",
        sub: "Group 2 • Research Archive (kmp_)",
        icon: "bi-journal-richtext",
        color: "secondary",
        sla: "Instant Access",
        desc: "Search published college research papers, undergraduate theses, and capstone project documentation."
    },
    orgfinance: {
        title: "Student Organizations & Dues Management",
        sub: "Group 5 • Org Finance (orf_)",
        icon: "bi-wallet2",
        color: "warning",
        sla: "Instant Digital Receipt",
        desc: "Pay accredited student organization membership fees, track club dues balances, and obtain financial clearance."
    },
    orgleadership: {
        title: "Student Leadership & Council Directory",
        sub: "Group 6 • Student Leadership (sld_)",
        icon: "bi-person-lines-fill",
        color: "danger",
        sla: "Public Directory",
        desc: "Supreme Student Council (SSC) officers directory, leadership evaluation scores, candidate filings, and election notices."
    },
    retention: {
        title: "Academic Standing & Retention Predictor",
        sub: "Group 8 • Academic Analytics (ret_)",
        icon: "bi-graph-up-arrow",
        color: "success",
        sla: "Real-time Telemetry",
        desc: "View predictive academic performance standing, grade progression analysis, and academic advising notifications."
    }
};

// 1. Bottom Navigation Tab Switching
function switchAppTab(tabKey, clickedButton = null) {
    const screens = {
        home: document.getElementById('screenHome'),
        services: document.getElementById('screenServices'),
        clearance: document.getElementById('screenClearance'),
        alerts: document.getElementById('screenAlerts'),
        profile: document.getElementById('screenProfile')
    };

    // Hide all screens
    Object.values(screens).forEach(screen => {
        if (screen) screen.classList.remove('active-screen');
    });

    // Show chosen screen
    if (screens[tabKey]) {
        screens[tabKey].classList.add('active-screen');
    }

    // Scroll to top of screens container
    const container = document.getElementById('appScreensContainer');
    if (container) container.scrollTop = 0;

    // Update bottom nav active state
    document.querySelectorAll('.bottom-nav-item').forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('data-tab') === tabKey) {
            item.classList.add('active');
        }
    });

    // If alerts tab clicked, remove red badge dot
    if (tabKey === 'alerts') {
        const dot = document.querySelector('.bottom-nav-badge-dot');
        if (dot) dot.style.display = 'none';
    }
}

// 2. Real-time Service Search Filter
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('serviceSearchInput');
    const serviceCards = document.querySelectorAll('.service-item-card');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            serviceCards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? 'flex' : 'none';
            });
        });
    }

    // Update Live Clock in Status Bar
    function updateClock() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const formatted = `${hours}:${minutes < 10 ? '0' : ''}${minutes}`;
        const clockEl = document.getElementById('deviceClockTime');
        if (clockEl) clockEl.textContent = formatted;
    }
    updateClock();
    setInterval(updateClock, 30000);

    // Desktop Toggle: Simulator Frame vs Fullscreen
    const toggleBtn = document.getElementById('toggleSimulatorBtn');
    const wrapper = document.getElementById('appViewportWrapper');
    const toggleText = document.getElementById('toggleSimulatorText');
    if (toggleBtn && wrapper && toggleText) {
        toggleBtn.addEventListener('click', function () {
            const isFull = wrapper.classList.toggle('is-fullscreen');
            toggleText.textContent = isFull ? 'Phone Bezel View' : 'Fullscreen View';
        });
    }
});

// 3. Category Filter
function filterServices(category, buttonEl) {
    document.querySelectorAll('.btn-cat-pill').forEach(btn => btn.classList.remove('active'));
    buttonEl.classList.add('active');

    const serviceCards = document.querySelectorAll('.service-item-card');
    serviceCards.forEach(card => {
        if (category === 'all') {
            card.style.display = 'flex';
        } else {
            const cardCat = card.getAttribute('data-category');
            card.style.display = cardCat === category ? 'flex' : 'none';
        }
    });
}

// 4. Trigger Offcanvas Service Request Drawer
function triggerServiceDrawer(serviceKey) {
    const meta = SYSTEM_SERVICES[serviceKey];
    if (!meta) return;

    document.getElementById('serviceDrawerTitle').textContent = meta.title;
    document.getElementById('serviceDrawerSub').textContent = meta.sub;
    document.getElementById('serviceDrawerDesc').textContent = meta.desc;
    document.getElementById('serviceDrawerSla').textContent = meta.sla;
    document.getElementById('serviceDrawerInputKey').value = serviceKey;

    const iconBadge = document.getElementById('drawerIconBadge');
    if (iconBadge) {
        iconBadge.className = `p-2 rounded-3 bg-${meta.color} bg-opacity-25 text-${meta.color} fs-4`;
        iconBadge.innerHTML = `<i class="bi ${meta.icon}"></i>`;
    }

    // Reset Form Fields
    document.getElementById('servicePurposeInput').value = '';
    document.getElementById('serviceNotesInput').value = '';

    const drawerEl = document.getElementById('serviceRequestDrawer');
    if (drawerEl && typeof bootstrap !== 'undefined') {
        const bsDrawer = bootstrap.Offcanvas.getOrCreateInstance(drawerEl);
        bsDrawer.show();
    }
}

// 5. Handle Interactive Service Form Submit (Design Simulation)
function handleServiceFormSubmit(event) {
    event.preventDefault();
    const serviceKey = document.getElementById('serviceDrawerInputKey').value;
    const purpose = document.getElementById('servicePurposeInput').value;
    const meta = SYSTEM_SERVICES[serviceKey] || { title: 'Service' };

    // Close drawer
    const drawerEl = document.getElementById('serviceRequestDrawer');
    if (drawerEl && typeof bootstrap !== 'undefined') {
        const bsDrawer = bootstrap.Offcanvas.getInstance(drawerEl);
        if (bsDrawer) bsDrawer.hide();
    }

    // Trigger sweetalert simulation or native modal
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Request Transmitted!',
            html: `Your request for <strong>${meta.title}</strong> has been logged in the simulated workflow queue.<br><br><span class="badge bg-secondary text-warning">Ref ID: REQ-2026-${Math.floor(1000 + Math.random() * 9000)}</span>`,
            icon: 'success',
            background: '#171e2c',
            color: '#ffffff',
            confirmButtonColor: '#800020'
        });
    } else {
        alert(`Success: Your request for ${meta.title} has been submitted!`);
    }
}

// 6. Open Digital ID Modal
function openDigitalIdModal() {
    const modalEl = document.getElementById('digitalIdModal');
    if (modalEl && typeof bootstrap !== 'undefined') {
        const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
        bsModal.show();
    }
}

// 7. Clearance Download Simulation
function simulateClearanceDownload() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Digital Clearance Pass',
            html: 'Clearance Form AY 2026-2027 1st Semester is currently at <strong>80% Completion</strong>. 2 remaining stations (Property Custodian & Dean) are pending sign-off.',
            icon: 'info',
            background: '#171e2c',
            color: '#ffffff',
            confirmButtonColor: '#d4af37'
        });
    }
}

// 8. Mark all notifications as read
function markAllNotificationsRead() {
    const alerts = document.querySelectorAll('#screenAlerts .badge');
    alerts.forEach(badge => badge.classList.add('bg-secondary'));
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'All notifications marked as read',
            showConfirmButton: false,
            timer: 2000,
            background: '#171e2c',
            color: '#ffffff'
        });
    }
}
</script>

<?php
\Core\View::partial('scripts');
?>
