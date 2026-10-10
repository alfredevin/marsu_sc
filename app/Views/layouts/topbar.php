<?php
$user = auth();
$activeAY = setting('active_academic_year', '2026-2027');
$activeSem = setting('active_semester', '1');
$semLabel = ($activeSem == '1') ? '1st Sem' : (($activeSem == '2') ? '2nd Sem' : 'Summer');

// Context-aware search target
$currentUri = $_SERVER['REQUEST_URI'] ?? '';
$searchTarget = 'students';
$searchPlaceholder = 'Search students, staff, modules...';

if (str_contains($currentUri, 'employee')) {
    $searchTarget = 'employees';
    $searchPlaceholder = 'Search faculty & staff directory...';
} elseif (str_contains($currentUri, 'subject')) {
    $searchTarget = 'subjects';
    $searchPlaceholder = 'Search curriculum courses...';
} elseif (str_contains($currentUri, 'department')) {
    $searchTarget = 'departments';
    $searchPlaceholder = 'Search departments & colleges...';
}
?>

<header id="app-topbar">
    <div class="d-flex align-items-center gap-3">
        <!-- Mobile Sidebar Toggle -->
        <button id="sidebarToggleTop" class="btn btn-outline-secondary d-lg-none btn-sm" aria-label="Toggle navigation">
            <i class="bi bi-list fs-5"></i>
        </button>

        <!-- Global Search Bar Form -->
        <form action="<?= url($searchTarget) ?>" method="GET" class="d-none d-md-flex align-items-center position-relative m-0">
            <i class="bi bi-search position-absolute ms-3 text-muted" style="pointer-events: none;"></i>
            <input type="text" name="q" class="form-control form-control-sm ps-5 pe-3 bg-light border rounded-pill shadow-sm" 
                   placeholder="<?= e($searchPlaceholder) ?>" 
                   value="<?= e($_GET['q'] ?? '') ?>" 
                   style="width: 290px;">
        </form>

        <!-- Academic Session Indicator Dropdown Badge -->
        <div class="dropdown d-none d-sm-inline-block">
            <button class="btn btn-sm badge-gold rounded-pill px-3 py-1-5 d-inline-flex align-items-center gap-2 border-0 shadow-sm topbar-session-btn" 
                    type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Academic Term Details">
                <i class="bi bi-calendar-check text-marsu-burgundy"></i>
                <span>A.Y. <?= e($activeAY) ?> • <?= e($semLabel) ?></span>
                <i class="bi bi-chevron-down text-marsu-burgundy opacity-75" style="font-size: 0.65rem;"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-start shadow-sm border-0 p-3 mt-2" style="min-width: 260px;">
                <li class="small fw-bold text-uppercase text-muted mb-2 border-bottom pb-1">Academic Session</li>
                <li class="fw-bold text-marsu-burgundy fs-6">A.Y. <?= e($activeAY) ?></li>
                <li class="text-muted small mb-2"><?= e($semLabel) ?> • Regular Term</li>
                <li class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>Santa Cruz Campus</li>
                <li class="small text-success fw-semibold"><i class="bi bi-check-circle-fill me-1"></i>Active Semester</li>
                <?php if (can('core.settings.edit')): ?>
                    <li><hr class="dropdown-divider my-2"></li>
                    <li><a class="dropdown-item small text-marsu-burgundy p-0 fw-semibold" href="<?= url('settings') ?>"><i class="bi bi-gear me-1"></i>Academic Settings</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Topbar Right Actions -->
    <div class="d-flex align-items-center gap-2">
        <!-- Dark Mode Toggle Button -->
        <button id="themeToggleBtn" class="btn btn-sm btn-light border rounded-circle p-2 topbar-icon-btn" title="Toggle Light/Dark Theme">
            <i id="theme-icon" class="bi bi-moon-fill" style="color: var(--marsu-burgundy);"></i>
        </button>

        <!-- Notification Bell Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-light border rounded-circle p-2 position-relative topbar-icon-btn" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
                <i class="bi bi-bell-fill text-muted"></i>
                <span id="notifBadgeDot" class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle notif-pulse-dot">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-0 mt-2" style="width: 320px;">
                <li class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 fw-bold">Notifications Center</h6>
                        <span class="text-muted" style="font-size: 0.72rem;">Central Campus Alerts</span>
                    </div>
                    <span id="notifCountBadge" class="badge badge-burgundy">3 New</span>
                </li>
                <li class="notif-item p-2 border-bottom">
                    <a href="<?= url('students') ?>" class="dropdown-item py-2 px-1 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <i class="bi bi-people-fill text-success fs-5"></i>
                            <div>
                                <div class="small fw-semibold">866 Students Registered</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Master records loaded</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="notif-item p-2 border-bottom">
                    <a href="<?= url('dashboard') ?>" class="dropdown-item py-2 px-1 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <i class="bi bi-calendar-check text-primary fs-5"></i>
                            <div>
                                <div class="small fw-semibold">A.Y. 2026-2027 1st Semester</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Active academic term</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="notif-item p-2 border-bottom">
                    <a href="<?= url('roles') ?>" class="dropdown-item py-2 px-1 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <i class="bi bi-shield-check text-warning fs-5"></i>
                            <div>
                                <div class="small fw-semibold">RBAC Strict Security Active</div>
                                <div class="text-muted" style="font-size: 0.75rem;">System protected</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="p-2 text-center bg-light">
                    <a href="<?= url('audit') ?>" class="small text-marsu-burgundy fw-bold text-decoration-none">View System Audit Log</a>
                </li>
            </ul>
        </div>

        <div class="vr mx-2 text-muted" style="height: 24px;"></div>

        <!-- User Information Profile Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle py-1 px-2 rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="position-relative">
                    <?php $topbarAvatar = !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg'); ?>
                    <img src="<?= $topbarAvatar ?>" 
                         alt="Avatar" width="38" height="38" 
                         class="rounded-circle avatar-ring" style="object-fit: cover;">
                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle user-online-dot" title="Online"></span>
                </div>
                <div class="d-none d-lg-block text-start lh-1">
                    <div class="fw-bold small text-body"><?= e(($user['first_name'] ?? 'User') . ' ' . ($user['last_name'] ?? '')) ?></div>
                    <span class="text-muted" style="font-size: 0.72rem;"><?= e(ucfirst($user['role_name'] ?? ($user['role'] ?? 'User'))) ?></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2" style="min-width: 240px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold text-marsu-burgundy"><?= e(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?></div>
                    <div class="text-muted small mb-1"><?= e($user['email'] ?? '') ?></div>
                    <div class="d-flex align-items-center gap-1">
                        <span class="badge badge-burgundy" style="font-size: 0.68rem;"><?= e($user['role_name'] ?? ($user['role'] ?? 'User')) ?></span>
                        <span class="badge badge-gold" style="font-size: 0.68rem;">Santa Cruz</span>
                    </div>
                </li>
                <li><a class="dropdown-item py-2" href="<?= url('profile') ?>"><i class="bi bi-person me-2 text-muted"></i>My Profile</a></li>
                <li><a class="dropdown-item py-2" href="<?= url('profile/password') ?>"><i class="bi bi-key me-2 text-muted"></i>Change Password</a></li>
                <?php if (can('core.audit.view')): ?>
                    <li><a class="dropdown-item py-2" href="<?= url('audit') ?>"><i class="bi bi-clock-history me-2 text-muted"></i>Activity Log</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item py-2" href="<?= url('uikit') ?>"><i class="bi bi-palette me-2 text-muted"></i>UI Styleguide</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="<?= url('logout') ?>" class="m-0">
                        <?= csrf_field() ?>
                        <button type="submit" class="dropdown-item text-danger py-2 fw-semibold">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
