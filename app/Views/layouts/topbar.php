<?php
$user = auth();
$activeAY = setting('active_academic_year', '2026-2027');
$activeSem = setting('active_semester', '1');
$semLabel = ($activeSem == '1') ? '1st Sem' : (($activeSem == '2') ? '2nd Sem' : 'Summer');
?>

<header id="app-topbar">
    <div class="d-flex align-items-center gap-3">
        <!-- Mobile Sidebar Toggle -->
        <button id="sidebarToggleTop" class="btn btn-outline-secondary d-lg-none btn-sm" aria-label="Toggle navigation">
            <i class="bi bi-list fs-5"></i>
        </button>

        <!-- Global Search Bar -->
        <div class="d-none d-md-flex align-items-center position-relative">
            <i class="bi bi-search position-absolute ms-3 text-muted"></i>
            <input type="text" class="form-control form-control-sm ps-5 bg-light border-0 rounded-pill" 
                   placeholder="Search students, staff, modules..." style="width: 280px;">
        </div>

        <!-- Academic Session Indicator Badge -->
        <span class="badge badge-gold rounded-pill px-3 py-2 d-none d-sm-inline-flex align-items-center gap-1">
            <i class="bi bi-calendar-check text-marsu-burgundy"></i>
            <span>A.Y. <?= e($activeAY) ?> • <?= e($semLabel) ?></span>
        </span>
    </div>

    <!-- Topbar Right Actions -->
    <div class="d-flex align-items-center gap-2">
        <!-- Dark Mode Toggle Button -->
        <button id="themeToggleBtn" class="btn btn-sm btn-light border rounded-circle p-2" title="Toggle Light/Dark Theme">
            <i id="themeIcon" class="bi bi-moon-fill" style="color: var(--marsu-burgundy);"></i>
        </button>

        <!-- Notification Bell Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-light border rounded-circle p-2 position-relative" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
                <i class="bi bi-bell-fill text-muted"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-0" style="width: 300px;">
                <li class="p-3 border-bottom bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">Notifications Center</h6>
                        <span class="badge badge-burgundy">3 New</span>
                    </div>
                </li>
                <li class="p-2 border-bottom">
                    <a href="#" class="dropdown-item py-2 px-1 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <i class="bi bi-file-earmark-check text-success fs-5"></i>
                            <div>
                                <div class="small fw-semibold">Enrollment period open</div>
                                <div class="text-muted" style="font-size: 0.75rem;">A.Y. 2026-2027 1st Semester</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="p-2 border-bottom">
                    <a href="#" class="dropdown-item py-2 px-1 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <i class="bi bi-database-check text-info fs-5"></i>
                            <div>
                                <div class="small fw-semibold">Core Database Seeded</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Master reference tables ready</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="p-2 text-center">
                    <a href="<?= url('audit') ?>" class="small text-marsu-burgundy fw-bold text-decoration-none">View System Audit Log</a>
                </li>
            </ul>
        </div>

        <div class="vr mx-2 text-muted" style="height: 24px;"></div>

        <!-- User Information Profile Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= asset('assets/img/undraw_profile.svg') ?>" 
                     alt="Avatar" width="38" height="38" 
                     class="rounded-circle avatar-ring">
                <div class="d-none d-lg-block text-start lh-1">
                    <div class="fw-bold small text-body"><?= e(($user['first_name'] ?? 'User') . ' ' . ($user['last_name'] ?? '')) ?></div>
                    <span class="text-muted" style="font-size: 0.72rem;"><?= e(ucfirst($user['role_name'] ?? ($user['role'] ?? 'User'))) ?></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold"><?= e(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?></div>
                    <div class="text-muted small"><?= e($user['email'] ?? '') ?></div>
                    <span class="badge badge-burgundy mt-1"><?= e($user['role_name'] ?? ($user['role'] ?? 'User')) ?></span>
                </li>
                <li><a class="dropdown-item py-2" href="<?= url('profile') ?>"><i class="bi bi-person me-2 text-muted"></i>My Profile</a></li>
                <li><a class="dropdown-item py-2" href="<?= url('profile/password') ?>"><i class="bi bi-key me-2 text-muted"></i>Change Password</a></li>
                <?php if (can('core.audit.view')): ?>
                    <li><a class="dropdown-item py-2" href="<?= url('audit') ?>"><i class="bi bi-clock-history me-2 text-muted"></i>Activity Log</a></li>
                <?php endif; ?>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="<?= url('logout') ?>" class="m-0">
                        <?= csrf_field() ?>
                        <button type="submit" class="dropdown-item text-danger py-2">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
