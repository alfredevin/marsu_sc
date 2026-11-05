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

/* ==========================================================================
   4. EXECUTIVE KPI & STAT CARDS (High Contrast, Crisp Typography, Accessible)
   ========================================================================== */
.card-kpi {
    position: relative;
    border-radius: 12px !important;
    border: 1px solid #e9ecef !important;
    border-left: 4.5px solid #800020 !important;
    background: #ffffff !important;
    padding: 1.15rem 1.25rem !important;
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1) !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04) !important;
    overflow: hidden;
}

.card-kpi:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 10px 22px rgba(0, 0, 0, 0.08) !important;
}

/* Border Accent Variants */
.card-kpi.border-burgundy,
.card-kpi.kpi-burgundy {
    border-color: #e9ecef !important;
    border-left-color: #800020 !important;
}

.card-kpi.border-gold,
.card-kpi.kpi-gold {
    border-color: #e9ecef !important;
    border-left-color: #D4AF37 !important;
}

.card-kpi.border-success,
.card-kpi.kpi-success {
    border-color: #e9ecef !important;
    border-left-color: #198754 !important;
}

.card-kpi.border-info,
.card-kpi.kpi-info {
    border-color: #e9ecef !important;
    border-left-color: #0d6efd !important;
}

/* KPI Typography - Crisp, legible, modern */
.kpi-label,
.card-kpi .text-muted.small.text-uppercase {
    font-size: 0.74rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.055em !important;
    color: #475569 !important;
    margin-bottom: 0.35rem !important;
    line-height: 1.25 !important;
}

.kpi-value,
.card-kpi .h3,
.card-kpi .h2 {
    font-size: 1.85rem !important;
    font-weight: 800 !important;
    line-height: 1.15 !important;
    letter-spacing: -0.025em !important;
    color: #0f172a !important;
    margin-bottom: 0.35rem !important;
    margin-top: 0 !important;
}

/* Accessible, high-contrast readable color classes for values (WCAG AA compliant) */
.kpi-value.text-marsu-burgundy,
.card-kpi .text-marsu-burgundy {
    color: #800020 !important;
}

/* Rich, high-contrast gold/amber (contrast ratio 5.6:1 against white, unlike pale #D4AF37) */
.kpi-value.text-gold,
.card-kpi .text-gold,
.text-gold-readable {
    color: #855700 !important;
}

.kpi-value.text-success,
.card-kpi .text-success,
.text-success-readable {
    color: #15803d !important;
}

.kpi-value.text-info,
.card-kpi .text-info,
.text-info-readable {
    color: #0369a1 !important;
}

/* Unit/Suffix inside KPI value */
.kpi-unit {
    font-size: 0.885rem !important;
    font-weight: 600 !important;
    color: #64748b !important;
    margin-left: 0.3rem;
    letter-spacing: normal;
    text-transform: none;
}

/* Subtext / helper line */
.kpi-subtext,
.card-kpi .small.text-muted {
    font-size: 0.78rem !important;
    font-weight: 500 !important;
    color: #64748b !important;
    line-height: 1.35 !important;
    margin-top: 0.35rem !important;
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

/* Soft Icon Badges */
.kpi-icon-badge {
    width: 44px;
    height: 44px;
    min-width: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    transition: transform 0.22s ease;
}

.card-kpi:hover .kpi-icon-badge {
    transform: scale(1.08);
}

.kpi-icon-badge.badge-burgundy {
    background-color: #f8e9ec;
    color: #800020;
}

.kpi-icon-badge.badge-gold {
    background-color: #fbf3d5;
    color: #855700;
}

.kpi-icon-badge.badge-success {
    background-color: #dcfce7;
    color: #15803d;
}

.kpi-icon-badge.badge-info {
    background-color: #e0f2fe;
    color: #0369a1;
}

/* Dark Mode Overrides for KPI cards */
[data-bs-theme="dark"] .card-kpi {
    background: #24040a !important;
    border-color: rgba(212, 175, 55, 0.22) !important;
}

[data-bs-theme="dark"] .card-kpi.border-burgundy,
[data-bs-theme="dark"] .card-kpi.kpi-burgundy {
    border-color: rgba(212, 175, 55, 0.22) !important;
    border-left-color: #ff859d !important;
}

[data-bs-theme="dark"] .card-kpi.border-gold,
[data-bs-theme="dark"] .card-kpi.kpi-gold {
    border-color: rgba(212, 175, 55, 0.22) !important;
    border-left-color: #fde047 !important;
}

[data-bs-theme="dark"] .card-kpi.border-success,
[data-bs-theme="dark"] .card-kpi.kpi-success {
    border-color: rgba(212, 175, 55, 0.22) !important;
    border-left-color: #4ade80 !important;
}

[data-bs-theme="dark"] .kpi-label,
[data-bs-theme="dark"] .card-kpi .text-muted.small.text-uppercase {
    color: #e2d9dc !important;
}

[data-bs-theme="dark"] .kpi-value,
[data-bs-theme="dark"] .card-kpi .h3,
[data-bs-theme="dark"] .card-kpi .h2 {
    color: #ffffff !important;
}

[data-bs-theme="dark"] .kpi-value.text-marsu-burgundy,
[data-bs-theme="dark"] .card-kpi .text-marsu-burgundy {
    color: #ff94a8 !important;
}

[data-bs-theme="dark"] .kpi-value.text-gold,
[data-bs-theme="dark"] .card-kpi .text-gold,
[data-bs-theme="dark"] .text-gold-readable {
    color: #fde047 !important;
}

[data-bs-theme="dark"] .kpi-value.text-success,
[data-bs-theme="dark"] .card-kpi .text-success,
[data-bs-theme="dark"] .text-success-readable {
    color: #4ade80 !important;
}

[data-bs-theme="dark"] .kpi-unit,
[data-bs-theme="dark"] .kpi-subtext,
[data-bs-theme="dark"] .card-kpi .small.text-muted {
    color: #c9b6bb !important;
}

[data-bs-theme="dark"] .kpi-icon-badge.badge-burgundy {
    background-color: rgba(128, 0, 32, 0.35);
    color: #ff94a8;
}

[data-bs-theme="dark"] .kpi-icon-badge.badge-gold {
    background-color: rgba(212, 175, 55, 0.22);
    color: #fde047;
}

[data-bs-theme="dark"] .kpi-icon-badge.badge-success {
    background-color: rgba(22, 163, 74, 0.22);
    color: #4ade80;
}
</style>
