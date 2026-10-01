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

        <!-- Global Omnisearch / Command Palette -->
        <div class="topbar-search-wrapper d-none d-md-block position-relative" id="topbarSearchContainer">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="pointer-events: none; z-index: 4;"></i>
            <input type="text" id="globalOmniSearchInput" 
                   class="form-control form-control-sm ps-5 rounded-pill topbar-search-input" 
                   placeholder="Search students, staff, modules... (Ctrl + K)" 
                   autocomplete="off" spellcheck="false">
            <div class="topbar-search-actions">
                <button type="button" class="topbar-search-clear-btn" id="globalSearchClearBtn" title="Clear search" aria-label="Clear">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
                <kbd class="topbar-search-kbd d-none d-lg-inline-block">Ctrl K</kbd>
            </div>

            <!-- Interactive Omnisearch Floating Dropdown -->
            <div class="topbar-search-dropdown" id="globalSearchDropdown">
                <!-- Direct Jump Queries -->
                <div id="omniDynamicActions" style="display: none;">
                    <div class="omni-group-header">Quick Action Search</div>
                    <a href="<?= url('students') ?>" class="omni-item" id="omniSearchStudentsAction">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-mortarboard-fill"></i></span>
                            <div>Search Students for <strong class="omni-query-term text-marsu-burgundy"></strong></div>
                        </div>
                        <span class="omni-badge">Students Masterlist</span>
                    </a>
                    <a href="<?= url('employees') ?>" class="omni-item" id="omniSearchEmployeesAction">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-person-badge-fill"></i></span>
                            <div>Search Faculty for <strong class="omni-query-term text-marsu-burgundy"></strong></div>
                        </div>
                        <span class="omni-badge">Faculty Directory</span>
                    </a>
                    <a href="<?= url('subjects') ?>" class="omni-item" id="omniSearchSubjectsAction">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-book-fill"></i></span>
                            <div>Search Subjects for <strong class="omni-query-term text-marsu-burgundy"></strong></div>
                        </div>
                        <span class="omni-badge">Curriculum Catalog</span>
                    </a>
                    <div class="dropdown-divider my-1"></div>
                </div>

                <!-- Core Navigation -->
                <div class="omni-group-header">Core Master Records</div>
                <div class="omni-nav-list">
                    <a href="<?= url('students') ?>" class="omni-item" data-keywords="students roster masterlist enrollment bsis bsit act 2026">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-mortarboard-fill"></i></span>
                            <div>
                                <div class="fw-semibold">Students Master Registry</div>
                                <small class="text-muted">866 enrolled students & programs</small>
                            </div>
                        </div>
                        <span class="omni-badge">Master Data</span>
                    </a>
                    <a href="<?= url('employees') ?>" class="omni-item" data-keywords="employees faculty staff teachers professors instructors">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-person-badge-fill"></i></span>
                            <div>
                                <div class="fw-semibold">Faculty & Staff Directory</div>
                                <small class="text-muted">42 university personnel & ranks</small>
                            </div>
                        </div>
                        <span class="omni-badge">Master Data</span>
                    </a>
                    <a href="<?= url('subjects') ?>" class="omni-item" data-keywords="subjects curriculum courses ite it cc gsc marinduque">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-book-fill"></i></span>
                            <div>
                                <div class="fw-semibold">Curriculum Subjects</div>
                                <small class="text-muted">80 academic courses & syllabi</small>
                            </div>
                        </div>
                        <span class="omni-badge">Curriculum</span>
                    </a>
                    <a href="<?= url('departments') ?>" class="omni-item" data-keywords="departments colleges cics cba cme cas coe agriculture">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-diagram-3-fill"></i></span>
                            <div>
                                <div class="fw-semibold">Colleges & Departments</div>
                                <small class="text-muted">Academic units & division heads</small>
                            </div>
                        </div>
                        <span class="omni-badge">Colleges</span>
                    </a>
                    <a href="<?= url('dashboard') ?>" class="omni-item" data-keywords="dashboard executive analytics statistics kpi kpis overview home">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-speedometer2"></i></span>
                            <div>
                                <div class="fw-semibold">Executive Dashboard</div>
                                <small class="text-muted">Campus analytics, KPIs & charts</small>
                            </div>
                        </div>
                        <span class="omni-badge">Main</span>
                    </a>
                    <a href="<?= url('roles') ?>" class="omni-item" data-keywords="roles permissions rbac access security matrix privileges">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-shield-lock-fill"></i></span>
                            <div>
                                <div class="fw-semibold">Roles & RBAC Matrix</div>
                                <small class="text-muted">Security privileges & role access</small>
                            </div>
                        </div>
                        <span class="omni-badge">Security</span>
                    </a>
                    <a href="<?= url('audit') ?>" class="omni-item" data-keywords="audit trail logs activity security history">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-journal-text"></i></span>
                            <div>
                                <div class="fw-semibold">System Audit Trail</div>
                                <small class="text-muted">User activities & security events</small>
                            </div>
                        </div>
                        <span class="omni-badge">Security</span>
                    </a>
                </div>

                <!-- Sub-Modules Section -->
                <div class="omni-group-header">Student Sub-Modules</div>
                <div class="omni-modules-list">
                    <a href="<?= url('clearance') ?>" class="omni-item" data-keywords="clearance signing departments accounts library laboratory">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-check2-all"></i></span>
                            <span class="fw-semibold">Online Clearance</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('retention') ?>" class="omni-item" data-keywords="retention dropouts at-risk grades attendance warning">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-graph-up-arrow"></i></span>
                            <span class="fw-semibold">Retention & Risk Tracker</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('guidance') ?>" class="omni-item" data-keywords="guidance counseling appointments behavioral case notes">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-heart-pulse"></i></span>
                            <span class="fw-semibold">Guidance & Counseling</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('health') ?>" class="omni-item" data-keywords="health medical dental clinic records consultation prescriptions">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-hospital"></i></span>
                            <span class="fw-semibold">Health & Dental Clinic</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('welfare') ?>" class="omni-item" data-keywords="welfare scholarship grantees aid allowances financial assistance">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-hand-thumbs-up"></i></span>
                            <span class="fw-semibold">Student Welfare & Aid</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('housing') ?>" class="omni-item" data-keywords="housing boarding house dorm dormitories landlords rooms vacancy">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-house-door"></i></span>
                            <span class="fw-semibold">Housing & Boarding Houses</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('orgfinance') ?>" class="omni-item" data-keywords="orgfinance organization funds dues disbursements budget receipt">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-cash-coin"></i></span>
                            <span class="fw-semibold">Org Financial Management</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('orgleadership') ?>" class="omni-item" data-keywords="orgleadership student council ssg elections officers accreditation">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-trophy"></i></span>
                            <span class="fw-semibold">Org Leadership & Council</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('assets') ?>" class="omni-item" data-keywords="assets inventory equipment computers custody maintenance property">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-box-seam"></i></span>
                            <span class="fw-semibold">Campus Assets & Inventory</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('workload') ?>" class="omni-item" data-keywords="workload faculty teaching units schedule load assignments">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-calendar3-range"></i></span>
                            <span class="fw-semibold">Faculty Workload & Schedule</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                    <a href="<?= url('expense4ps') ?>" class="omni-item" data-keywords="expense4ps 4ps pantawid dswd beneficiaries budget allowance">
                        <div class="d-flex align-items-center">
                            <span class="omni-item-icon"><i class="bi bi-wallet2"></i></span>
                            <span class="fw-semibold">4Ps Student Expense Tracker</span>
                        </div>
                        <span class="omni-badge">Module</span>
                    </a>
                </div>

                <div id="omniNoResults" class="p-3 text-center text-muted small" style="display: none;">
                    <i class="bi bi-search me-1"></i>No direct matches found. Press <kbd>Enter</kbd> to search students roster.
                </div>
            </div>
        </div>

        <!-- Academic Session Interactive Dropdown Pill -->
        <div class="dropdown d-none d-sm-inline-block">
            <button class="btn btn-sm badge-gold rounded-pill px-3 py-1-5 d-inline-flex align-items-center gap-2 border-0 shadow-sm topbar-session-btn" 
                    type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Click to view Academic Session details">
                <i class="bi bi-calendar-check text-marsu-burgundy"></i>
                <span>A.Y. <?= e($activeAY) ?> • <?= e($semLabel) ?></span>
                <i class="bi bi-chevron-down text-marsu-burgundy opacity-75" style="font-size: 0.65rem;"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-start shadow-lg border-0 p-3 mt-2 topbar-session-dropdown" style="min-width: 290px;">
                <div class="d-flex align-items-center justify-content-between pb-2 mb-2 border-bottom">
                    <span class="small fw-bold text-uppercase text-muted" style="letter-spacing: 0.5px;">Academic Session</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                        <i class="bi bi-record-circle-fill me-1"></i>Active Term
                    </span>
                </div>
                <div class="mb-2">
                    <div class="fw-bold text-marsu-burgundy fs-6">Academic Year <?= e($activeAY) ?></div>
                    <div class="text-body small"><?= e($semLabel) ?> (Regular Semester)</div>
                </div>
                <div class="bg-light p-2 rounded-2 small text-muted mb-3 border">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Campus:</span>
                        <span class="fw-semibold text-body">Santa Cruz Campus</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Current Cycle:</span>
                        <span class="fw-semibold text-body">Midterm Period</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Term Duration:</span>
                        <span class="fw-semibold text-body">Aug 2026 – Dec 2026</span>
                    </div>
                </div>
                <div class="d-grid gap-1">
                    <a href="<?= url('students') ?>" class="btn btn-sm btn-outline-marsu text-start d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-mortarboard me-2"></i>View Enrolled Students</span>
                        <i class="bi bi-arrow-right small"></i>
                    </a>
                    <?php if (can('core.settings.edit')): ?>
                        <a href="<?= url('settings') ?>" class="btn btn-sm btn-light border text-start d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-sliders me-2 text-muted"></i>Academic Settings</span>
                            <i class="bi bi-arrow-right small text-muted"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Topbar Right Actions -->
    <div class="d-flex align-items-center gap-2">
        <!-- Dark / Light Mode Toggle Button -->
        <button id="themeToggleBtn" class="btn btn-sm btn-light border rounded-circle topbar-icon-btn position-relative" 
                title="Toggle Light / Dark Mode" aria-label="Toggle Theme">
            <i id="theme-icon" class="bi bi-moon-fill" style="color: var(--marsu-burgundy);"></i>
        </button>

        <!-- Notification Bell Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-light border rounded-circle topbar-icon-btn position-relative" 
                    id="notifBellBtn" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications Center">
                <i class="bi bi-bell-fill text-muted"></i>
                <span id="notifBadgeDot" class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle notif-pulse-dot">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 py-0 mt-2 topbar-notif-menu" style="width: 320px;">
                <li class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 fw-bold">Notifications</h6>
                        <span class="text-muted" style="font-size: 0.72rem;">Central Campus Alerts</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span id="notifCountBadge" class="badge badge-burgundy">3 New</span>
                        <button type="button" id="markAllReadBtn" class="btn btn-link btn-sm p-0 ms-1 text-decoration-none text-muted small" title="Mark all as read">
                            <i class="bi bi-check2-all fs-6"></i>
                        </button>
                    </div>
                </li>
                <li class="notif-item p-2 border-bottom">
                    <a href="<?= url('students') ?>" class="dropdown-item py-2 px-2 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <div class="notif-icon-circle bg-success bg-opacity-10 text-success">
                                <i class="bi bi-person-check-fill fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-semibold text-body">866 Students Synchronized</div>
                                <div class="text-muted small" style="font-size: 0.73rem;">Official BSIT, BSIS, ACT roster active</div>
                                <div class="text-muted" style="font-size: 0.68rem;"><i class="bi bi-clock me-1"></i>Just now</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="notif-item p-2 border-bottom">
                    <a href="<?= url('dashboard') ?>" class="dropdown-item py-2 px-2 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <div class="notif-icon-circle bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-calendar-event-fill fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-semibold text-body">A.Y. 2026-2027 1st Semester</div>
                                <div class="text-muted small" style="font-size: 0.73rem;">Enrollment & clearance channels live</div>
                                <div class="text-muted" style="font-size: 0.68rem;"><i class="bi bi-clock me-1"></i>1 hr ago</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="notif-item p-2 border-bottom">
                    <a href="<?= url('roles') ?>" class="dropdown-item py-2 px-2 text-wrap rounded">
                        <div class="d-flex gap-2">
                            <div class="notif-icon-circle bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-shield-fill-check fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-semibold text-body">RBAC Security Active</div>
                                <div class="text-muted small" style="font-size: 0.73rem;">Audit logging & deny-by-default enforced</div>
                                <div class="text-muted" style="font-size: 0.68rem;"><i class="bi bi-clock me-1"></i>Today</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="p-2 text-center bg-light rounded-bottom">
                    <a href="<?= url('audit') ?>" class="small text-marsu-burgundy fw-bold text-decoration-none d-inline-flex align-items-center gap-1">
                        <span>View System Audit Trail</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="vr mx-2 text-muted" style="height: 24px;"></div>

        <!-- User Information Profile Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle topbar-profile-trigger py-1 px-2 rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="position-relative">
                    <img src="<?= asset('assets/img/undraw_profile.svg') ?>" 
                         alt="Avatar" width="38" height="38" 
                         class="rounded-circle avatar-ring">
                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle user-online-dot" title="Online"></span>
                </div>
                <div class="d-none d-lg-block text-start lh-1">
                    <div class="fw-bold small text-body topbar-username"><?= e(($user['first_name'] ?? 'User') . ' ' . ($user['last_name'] ?? '')) ?></div>
                    <span class="text-muted" style="font-size: 0.72rem;"><?= e(ucfirst($user['role_name'] ?? ($user['role'] ?? 'User'))) ?></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 py-2 topbar-profile-menu" style="min-width: 240px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold text-marsu-burgundy"><?= e(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?></div>
                    <div class="text-muted small mb-1"><?= e($user['email'] ?? '') ?></div>
                    <div class="d-flex align-items-center gap-1 flex-wrap">
                        <span class="badge badge-burgundy" style="font-size: 0.68rem;"><?= e($user['role_name'] ?? ($user['role'] ?? 'User')) ?></span>
                        <span class="badge badge-gold" style="font-size: 0.68rem;">Santa Cruz Campus</span>
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
