<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 1 & 2 - Student Self-Service Academic Portal
 * View: Shared Navigation Bar for Student Portal (student_nav.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
$activeTab = $activeTab ?? '';
?>
<style>
.bg-marsu-burgundy {
    background-color: #800020 !important;
}
.nav-pills .nav-link.active.bg-marsu-burgundy {
    background-color: #800020 !important;
    color: #fff !important;
    box-shadow: 0 2px 4px rgba(128, 0, 32, 0.25);
}
.nav-pills .nav-link:hover:not(.active) {
    background-color: #f8f9fa;
    color: #800020;
}
</style>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-2 px-3">
        <ul class="nav nav-pills flex-column flex-md-row gap-1">
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'dashboard' ? 'active bg-marsu-burgundy text-white' : 'text-secondary' ?> py-2 px-3 fw-semibold small" 
                   href="<?= url('retention/my') ?>">
                    <i class="bi bi-speedometer2 me-1"></i> Snapshot
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'profile' ? 'active bg-marsu-burgundy text-white' : 'text-secondary' ?> py-2 px-3 fw-semibold small" 
                   href="<?= url('retention/my/profile') ?>">
                    <i class="bi bi-person-badge me-1"></i> My Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'grades' ? 'active bg-marsu-burgundy text-white' : 'text-secondary' ?> py-2 px-3 fw-semibold small" 
                   href="<?= url('retention/my/grades') ?>">
                    <i class="bi bi-card-checklist me-1"></i> Grade Report
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'attendance' ? 'active bg-marsu-burgundy text-white' : 'text-secondary' ?> py-2 px-3 fw-semibold small" 
                   href="<?= url('retention/my/attendance') ?>">
                    <i class="bi bi-calendar-check me-1"></i> Attendance
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'deficiencies' ? 'active bg-marsu-burgundy text-white' : 'text-secondary' ?> py-2 px-3 fw-semibold small" 
                   href="<?= url('retention/my/deficiencies') ?>">
                    <i class="bi bi-exclamation-triangle me-1"></i> Deficiencies &amp; INCs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'progress' ? 'active bg-marsu-burgundy text-white' : 'text-secondary' ?> py-2 px-3 fw-semibold small" 
                   href="<?= url('retention/my/progress') ?>">
                    <i class="bi bi-mortarboard me-1"></i> Academic Progress
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'conduct' ? 'active bg-marsu-burgundy text-white' : 'text-secondary' ?> py-2 px-3 fw-semibold small" 
                   href="<?= url('retention/my/conduct') ?>">
                    <i class="bi bi-shield-check me-1"></i> Conduct Notices
                </a>
            </li>
        </ul>
    </div>
</div>
