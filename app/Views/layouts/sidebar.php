<?php
use Core\ModuleLoader;
use Core\Permission;

if (!function_exists('isActive')) {
    function isActive(?string $route, bool $exact = true): string {
        if ($route === null || trim($route) === '') {
            return '';
        }
        $target = trim($route, '/');

        // 1. Resolve relative application route
        $r = $_GET['r'] ?? '';
        if ($r !== '') {
            $path = trim($r, '/');
        } else {
            $uri = (string)($_SERVER['REQUEST_URI'] ?? '');
            $path = (string)(parse_url($uri, PHP_URL_PATH) ?? '');
            $path = trim($path, '/');

            // Strip project subfolder (e.g. "marsu_sc")
            $scriptDir = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
            $subfolder = preg_replace('#/public$#', '', $scriptDir);
            if ($subfolder !== '' && str_starts_with($path, $subfolder)) {
                $path = trim(substr($path, strlen($subfolder)), '/');
            }
        }

        // 2. Dashboard handling
        if ($target === 'dashboard') {
            return ($path === '' || $path === 'dashboard' || $path === 'index.php') ? 'active' : '';
        }

        // 3. Exact matching for sub-links
        if ($exact) {
            return ($path === $target) ? 'active' : '';
        }

        // 4. Prefix matching for module groups
        return ($path === $target || str_starts_with($path, $target . '/')) ? 'active' : '';
    }
}

$moduleNavGroups = ModuleLoader::getNavItems();
?>

<aside id="app-sidebar">
    <!-- Sidebar Brand -->
    <a href="<?= url('dashboard') ?>" class="sidebar-brand">
        <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Seal">
        <div>
            <div class="sidebar-brand-title">MarSU ERP</div>
            <div class="sidebar-brand-sub">CICS Central Core</div>
        </div>
    </a>

    <!-- Navigation Rail (Flex Scrolling inside 100vh Fixed Sidebar) -->
    <div class="sidebar-nav-scroll py-2">
        <!-- Dashboard & Student Portal -->
        <ul class="nav flex-column mb-0">
            <li class="nav-item <?= isActive('dashboard') ?>">
                <a class="nav-link <?= isActive('dashboard') ?>" href="<?= url('dashboard') ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item <?= isActive('student-portal') ?>">
                <a class="nav-link <?= isActive('student-portal') ?>" href="<?= url('student-portal') ?>">
                    <i class="bi bi-phone"></i>
                    <span>Student Mobile App</span>
                    <span class="badge badge-gold ms-auto" style="font-size: 0.62rem;">PORTAL</span>
                </a>
            </li>
        </ul>

        <!-- MASTER DATA SECTION -->
        <?php if (can('core.students.view') || can('core.employees.view') || can('core.departments.view') || can('core.subjects.view')): ?>
            <div class="sidebar-heading">Master Data</div>
            <ul class="nav flex-column mb-0">
                <?php if (can('core.students.view')): ?>
                    <li class="nav-item <?= isActive('students') ?>">
                        <a class="nav-link <?= isActive('students') ?>" href="<?= url('students') ?>">
                            <i class="bi bi-mortarboard-fill"></i>
                            <span>Students</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.employees.view')): ?>
                    <li class="nav-item <?= isActive('employees') ?>">
                        <a class="nav-link <?= isActive('employees') ?>" href="<?= url('employees') ?>">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Employees</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.departments.view')): ?>
                    <li class="nav-item <?= isActive('departments') ?>">
                        <a class="nav-link <?= isActive('departments') ?>" href="<?= url('departments') ?>">
                            <i class="bi bi-diagram-3-fill"></i>
                            <span>Colleges & Depts</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.programs.view')): ?>
                    <li class="nav-item <?= isActive('programs') ?>">
                        <a class="nav-link <?= isActive('programs') ?>" href="<?= url('programs') ?>">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            <span>Programs</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.subjects.view')): ?>
                    <li class="nav-item <?= isActive('subjects') ?>">
                        <a class="nav-link <?= isActive('subjects') ?>" href="<?= url('subjects') ?>">
                            <i class="bi bi-book-fill"></i>
                            <span>Subjects</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.academics.view')): ?>
                    <li class="nav-item <?= isActive('academics') ?>">
                        <a class="nav-link <?= isActive('academics') ?>" href="<?= url('academics') ?>">
                            <i class="bi bi-calendar3"></i>
                            <span>Academic Calendar</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.facilities.view')): ?>
                    <li class="nav-item <?= isActive('facilities') ?>">
                        <a class="nav-link <?= isActive('facilities') ?>" href="<?= url('facilities') ?>">
                            <i class="bi bi-building"></i>
                            <span>Buildings & Rooms</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.organizations.view')): ?>
                    <li class="nav-item <?= isActive('organizations') ?>">
                        <a class="nav-link <?= isActive('organizations') ?>" href="<?= url('organizations') ?>">
                            <i class="bi bi-people-fill"></i>
                            <span>Student Orgs</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>

        <!-- DYNAMIC STUDENT MODULES SECTION -->
        <?php if (!empty($moduleNavGroups)): ?>
            <div class="sidebar-heading">Student Modules</div>
            <ul class="nav flex-column mb-0">
                <?php foreach ($moduleNavGroups as $group): ?>
                    <?php if (!empty($group['items'])): ?>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center justify-content-between" 
                               href="#mod_<?= e($group['slug']) ?>" 
                               data-bs-toggle="collapse" 
                               aria-expanded="<?= isActive($group['slug'], false) ? 'true' : 'false' ?>">
                                <div>
                                    <i class="bi <?= e($group['icon']) ?>"></i>
                                    <span><?= e($group['title']) ?></span>
                                </div>
                                <i class="bi bi-chevron-down submenu-arrow small" style="font-size: 0.75rem; width: auto;"></i>
                            </a>
                            <div class="collapse <?= isActive($group['slug'], false) ? 'show' : '' ?>" id="mod_<?= e($group['slug']) ?>">
                                <ul class="sidebar-submenu">
                                    <?php foreach ($group['items'] as $subIdx => $subItem): ?>
                                        <?php if (!empty($subItem['children'])): ?>
                                            <?php 
                                                $childActive = false;
                                                foreach ($subItem['children'] as $c) {
                                                    if (!empty($c['route']) && isActive($c['route'], true) === 'active') {
                                                        $childActive = true;
                                                        break;
                                                    }
                                                }
                                                $subCollapseId = 'sub_' . e($group['slug']) . '_' . $subIdx;
                                            ?>
                                            <li class="nav-item">
                                                <a class="sidebar-category-toggle nav-link d-flex align-items-center justify-content-between <?= $childActive ? 'category-active' : '' ?>" 
                                                   href="#<?= $subCollapseId ?>" 
                                                   data-bs-toggle="collapse" 
                                                   aria-expanded="<?= $childActive ? 'true' : 'false' ?>">
                                                    <span class="d-flex align-items-center">
                                                        <?php if (!empty($subItem['icon'])): ?>
                                                            <i class="bi <?= e($subItem['icon']) ?> me-2"></i>
                                                        <?php endif; ?>
                                                        <span><?= e($subItem['label']) ?></span>
                                                    </span>
                                                    <i class="bi bi-chevron-down submenu-arrow"></i>
                                                </a>
                                                <div class="collapse <?= $childActive ? 'show' : '' ?>" id="<?= $subCollapseId ?>">
                                                    <ul class="sidebar-nested-submenu">
                                                        <?php foreach ($subItem['children'] as $child): ?>
                                                            <li>
                                                                <a class="nav-link <?= !empty($child['route']) ? isActive($child['route'], true) : '' ?>" 
                                                                   href="<?= url($child['route'] ?? '') ?>">
                                                                    <i class="bi bi-dash me-1 opacity-50"></i>
                                                                    <?= e($child['label']) ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php elseif (!empty($subItem['type']) && $subItem['type'] === 'header'): ?>
                                            <li class="sidebar-subheading px-4 pt-2 pb-1 text-uppercase text-white-50" style="font-size: 0.68rem; letter-spacing: 0.05rem; font-weight: 700;">
                                                <?= e($subItem['label']) ?>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a class="nav-link <?= !empty($subItem['route']) ? isActive($subItem['route'], true) : '' ?>" href="<?= url($subItem['route'] ?? '') ?>">
                                                    <?= e($subItem['label']) ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item <?= isActive($group['route'] ?? '') ?>">
                            <a class="nav-link <?= isActive($group['route'] ?? '') ?>" href="<?= url($group['route'] ?? '') ?>">
                                <i class="bi <?= e($group['icon']) ?>"></i>
                                <span><?= e($group['title']) ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- ADMINISTRATION SECTION -->
        <?php if (can('core.roles.view') || can('core.users.view') || can('core.audit.view') || can('core.settings.view')): ?>
            <div class="sidebar-heading">Administration</div>
            <ul class="nav flex-column mb-0">
                <?php if (can('core.roles.view')): ?>
                    <li class="nav-item <?= isActive('roles') ?>">
                        <a class="nav-link <?= isActive('roles') ?>" href="<?= url('roles') ?>">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span>Roles & RBAC</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.users.view')): ?>
                    <li class="nav-item <?= isActive('users') ?>">
                        <a class="nav-link <?= isActive('users') ?>" href="<?= url('users') ?>">
                            <i class="bi bi-person-gear"></i>
                            <span>User Accounts</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.audit.view')): ?>
                    <li class="nav-item <?= isActive('audit') ?>">
                        <a class="nav-link <?= isActive('audit') ?>" href="<?= url('audit') ?>">
                            <i class="bi bi-clock-history"></i>
                            <span>Audit Trail</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.modules.view')): ?>
                    <li class="nav-item <?= isActive('modules') ?>">
                        <a class="nav-link <?= isActive('modules') ?>" href="<?= url('modules') ?>">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                            <span>Module Manager</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (can('core.settings.view')): ?>
                    <li class="nav-item <?= isActive('settings') ?>">
                        <a class="nav-link <?= isActive('settings') ?>" href="<?= url('settings') ?>">
                            <i class="bi bi-sliders"></i>
                            <span>System Settings</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item <?= isActive('ui-kit') ?>">
                    <a class="nav-link <?= isActive('ui-kit') ?>" href="<?= url('ui-kit') ?>">
                        <i class="bi bi-palette-fill"></i>
                        <span>UI Kit Styleguide</span>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Sidebar Bottom Collapse Button -->
    <div class="sidebar-footer p-2 text-center">
        <button id="sidebarToggle" class="btn btn-sm text-white-50 w-100 py-1" title="Toggle Sidebar">
            <i class="bi bi-chevron-compact-left fs-5"></i>
        </button>
    </div>
</aside>
