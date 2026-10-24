<?php
/**
 * MarSU ERP - Housing Module (ISHAMIS)
 * System Gold Theme & User-Friendly Navigation Styles
 * Adheres strictly to MarSU ERP Design System (#D4AF37 Gold & #800020 Burgundy)
 */
?>
<style>
/* ==========================================================================
   1. SUB-NAVIGATION PILLS (MarSU Gold System Design)
   ========================================================================== */
.custom-nav-pills-wrapper {
    margin-bottom: 1.5rem;
}

.nav-pills.custom-nav-pills {
    background: #ffffff;
    padding: 6px 8px;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    display: inline-flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 6px;
    max-width: 100%;
}

.custom-nav-pills .nav-item {
    margin: 0;
}

/* Base Pill Style (Inactive State) */
.custom-nav-pills .nav-link,
.nav-pills .nav-link:not(.active) {
    color: #495057 !important;
    font-weight: 500;
    font-size: 0.885rem;
    border-radius: 8px !important;
    padding: 0.45rem 1rem !important;
    background: transparent;
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    transition: all 0.22s ease-in-out;
    text-decoration: none;
    cursor: pointer;
}

.custom-nav-pills .nav-link i,
.nav-pills .nav-link:not(.active) i {
    color: #6c757d;
    transition: color 0.2s ease;
}

/* Hover State */
.custom-nav-pills .nav-link:hover,
.nav-pills .nav-link:not(.active):hover {
    color: #800020 !important;
    background-color: #fff9e6 !important;
    border-color: rgba(212, 175, 55, 0.35) !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(212, 175, 55, 0.15);
}

.custom-nav-pills .nav-link:hover i,
.nav-pills .nav-link:not(.active):hover i {
    color: #b8922a !important;
}

/* Active State: The Signature MarSU System Gold */
.custom-nav-pills .nav-link.active,
.nav-pills .nav-link.active,
.custom-nav-pills .nav-link.active:focus,
.custom-nav-pills .nav-link.active:hover {
    background: linear-gradient(135deg, #e8c65d 0%, #D4AF37 100%) !important;
    color: #4a0011 !important;
    font-weight: 700 !important;
    border: 1px solid #b8922a !important;
    box-shadow: 0 3px 8px rgba(212, 175, 55, 0.38) !important;
    transform: translateY(-1px);
}

.custom-nav-pills .nav-link.active i,
.nav-pills .nav-link.active i {
    color: #4a0011 !important;
}

/* ==========================================================================
   2. DARK THEME SUPPORT
   ========================================================================== */
[data-bs-theme="dark"] .nav-pills.custom-nav-pills {
    background: #1f0308;
    border-color: rgba(212, 175, 55, 0.25);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
}

[data-bs-theme="dark"] .custom-nav-pills .nav-link,
[data-bs-theme="dark"] .nav-pills .nav-link:not(.active) {
    color: #e2d9dc !important;
}

[data-bs-theme="dark"] .custom-nav-pills .nav-link i,
[data-bs-theme="dark"] .nav-pills .nav-link:not(.active) i {
    color: #a89ba0;
}

[data-bs-theme="dark"] .custom-nav-pills .nav-link:hover,
[data-bs-theme="dark"] .nav-pills .nav-link:not(.active):hover {
    color: #fbf3d5 !important;
    background-color: rgba(212, 175, 55, 0.15) !important;
    border-color: rgba(212, 175, 55, 0.4) !important;
}

[data-bs-theme="dark"] .custom-nav-pills .nav-link:hover i,
[data-bs-theme="dark"] .nav-pills .nav-link:not(.active):hover i {
    color: #fce89e !important;
}

[data-bs-theme="dark"] .custom-nav-pills .nav-link.active,
[data-bs-theme="dark"] .nav-pills .nav-link.active {
    background: linear-gradient(135deg, #e8c65d 0%, #D4AF37 100%) !important;
    color: #240008 !important;
    border-color: #fce89e !important;
    box-shadow: 0 3px 12px rgba(212, 175, 55, 0.45) !important;
}

[data-bs-theme="dark"] .custom-nav-pills .nav-link.active i,
[data-bs-theme="dark"] .nav-pills .nav-link.active i {
    color: #240008 !important;
}

/* ==========================================================================
   3. MARSU SYSTEM DESIGN TOKENS & USER-FRIENDLY UTILITIES
   ========================================================================== */
.text-gold {
    color: #D4AF37 !important;
}
.text-gold-dark {
    color: #b8922a !important;
}
.bg-gold {
    background-color: #D4AF37 !important;
    color: #4a0011 !important;
}
.bg-gold-subtle {
    background-color: #fbf3d5 !important;
    color: #5c0016 !important;
}
.border-gold {
    border-color: #D4AF37 !important;
}
.border-gold-subtle {
    border-color: rgba(212, 175, 55, 0.35) !important;
}

/* Gold Accent Badge */
.badge-gold {
    background-color: #fbf3d5 !important;
    color: #5c0016 !important;
    font-weight: 600;
    padding: 0.35em 0.65em;
    border-radius: 6px;
    border: 1px solid rgba(212, 175, 55, 0.4) !important;
}

[data-bs-theme="dark"] .badge-gold {
    background-color: rgba(212, 175, 55, 0.18) !important;
    color: #fce89e !important;
    border-color: rgba(212, 175, 55, 0.4) !important;
}

/* Gold Buttons */
.btn-accent,
.btn-gold {
    background-color: #D4AF37 !important;
    border-color: #b8922a !important;
    color: #4a0011 !important;
    font-weight: 600;
    padding: 0.4rem 0.95rem;
    border-radius: 0.5rem;
    transition: all 0.22s ease;
    box-shadow: 0 2px 5px rgba(212, 175, 55, 0.25);
}

.btn-accent:hover,
.btn-gold:hover {
    background-color: #b8922a !important;
    border-color: #9c7b22 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.35);
    transform: translateY(-1px);
}

.btn-outline-gold {
    color: #9c7b22 !important;
    border-color: #D4AF37 !important;
    background: transparent;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-outline-gold:hover {
    background-color: #D4AF37 !important;
    border-color: #D4AF37 !important;
    color: #4a0011 !important;
    box-shadow: 0 2px 6px rgba(212, 175, 55, 0.25);
}

[data-bs-theme="dark"] .btn-outline-gold {
    color: #e5c158 !important;
    border-color: #e5c158 !important;
}

/* Gold Progress Bars */
.progress-bar-gold {
    background: linear-gradient(90deg, #D4AF37 0%, #e8c65d 100%) !important;
}

/* User-Friendly Focus Rings in MarSU Gold */
.form-control:focus,
.form-select:focus {
    border-color: #D4AF37 !important;
    box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25) !important;
}

/* Card KPI Polish */
.card-kpi {
    border-radius: 10px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card-kpi:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08) !important;
}
</style>
