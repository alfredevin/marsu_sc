<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-graph-up me-2 text-gold"></i><?= e($moduleName) ?>
        </h1>
        <p class="text-muted small mb-0">Student profiles, academic grade progress, class performance monitoring, and daily attendance tracking.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('analytics/profile') ?>" class="btn btn-marsu btn-sm">
            <i class="bi bi-person-lines-fill me-1"></i>Student Profiles
        </a>
        <a href="<?= url('analytics/gradestracking') ?>" class="btn btn-outline-marsu btn-sm">
            <i class="bi bi-pencil-square me-1"></i>Grades Tracking
        </a>
    </div>
</div>

<!-- Designated Module Workspace Banner -->
<div class="card border-0 mb-4 shadow-sm" style="background: linear-gradient(135deg, #800020 0%, #4a0013 100%); color: white; border-radius: 12px; overflow: hidden;">
    <div class="card-body p-4 position-relative">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 58px; height: 58px; background: rgba(212, 175, 55, 0.2); border: 2px solid #D4AF37;">
                    <i class="bi bi-mortarboard-fill text-gold fs-3"></i>
                </div>
                <div>
                    <span class="badge bg-gold text-dark fw-bold mb-1 px-2 py-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.7rem;">Designated Module Workspace • Group 8A</span>
                    <h4 class="fw-bold mb-1 text-white">Academic Analytics &amp; Student Monitoring System</h4>
                    <small class="text-white-50">
                        Logged in as: <strong><?= e($user['first_name'] ?? 'Bea') ?> <?= e($user['last_name'] ?? 'Manalo') ?></strong> (<code><?= e($user['username'] ?? 'group8a_lead') ?></code>) • Role: <span class="badge bg-light text-dark"><?= e($user['role_name'] ?? 'Module Lead: Academic Analytics') ?></span>
                    </small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= url('analytics/attendancerecords') ?>" class="btn btn-sm btn-light fw-semibold text-marsu-burgundy">
                    <i class="bi bi-calendar-check-fill me-1 text-gold"></i>Attendance
                </a>
                <a href="<?= url('analytics/progressreports') ?>" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-card-checklist me-1"></i>Progress Reports
                </a>
            </div>
        </div>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm border-0 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 0.72rem;">Active Students</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">866</div>
                    <small class="text-muted" style="font-size: 0.7rem;">Official MarSU Enrollees</small>
                </div>
                <div class="kpi-icon-badge" style="background: rgba(128, 0, 32, 0.1); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people-fill text-marsu-burgundy fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm border-0 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 0.72rem;">Average Attendance</div>
                    <div class="h3 font-weight-bold mb-0 text-success">94.8%</div>
                    <small class="text-muted" style="font-size: 0.7rem;">College-wide Attendance</small>
                </div>
                <div class="kpi-icon-badge badge-gold" style="width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-check2-circle text-dark fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm border-0 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 0.72rem;">Academic Subjects</div>
                    <div class="h3 font-weight-bold mb-0 text-primary">64</div>
                    <small class="text-muted" style="font-size: 0.7rem;">Curriculum Offerings</small>
                </div>
                <div class="kpi-icon-badge" style="background: rgba(13, 110, 253, 0.1); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-journal-bookmark-fill text-primary fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm border-0 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 0.72rem;">Module Security</div>
                    <div class="h4 font-weight-bold mb-0 text-success"><i class="bi bi-shield-lock-fill me-1"></i>Isolated</div>
                    <small class="text-muted" style="font-size: 0.7rem;">RBAC Group 8A Access</small>
                </div>
                <div class="kpi-icon-badge" style="background: rgba(25, 135, 84, 0.1); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-lock-fill text-success fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Access to the 3 Sub-Modules -->
<div class="row g-3 mb-4">
    <!-- Sub-module 1 -->
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="bi bi-people text-marsu-burgundy fs-5"></i>
                <h6 class="mb-0 fw-bold text-marsu-burgundy">1. Student Information</h6>
            </div>
            <div class="card-body p-3">
                <p class="small text-muted mb-3">Comprehensive 360-degree student profiles, academic history, enrollment status, and demographic breakdown.</p>
                <div class="list-group list-group-flush small">
                    <a href="<?= url('analytics/profile') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-person-circle me-2 text-gold"></i>Student Profiles</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/academichistory') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-clock-history me-2 text-gold"></i>Academic History</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/enrollmentrecords') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-card-list me-2 text-gold"></i>Enrollment Records</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/demographicinfo') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-pie-chart me-2 text-gold"></i>Demographic Info</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub-module 2 -->
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="bi bi-journal-bookmark text-marsu-burgundy fs-5"></i>
                <h6 class="mb-0 fw-bold text-marsu-burgundy">2. Academic Monitoring</h6>
            </div>
            <div class="card-body p-3">
                <p class="small text-muted mb-3">Real-time grades tracking across prelim, midterm, and final periods; subject bottleneck detection and progress reports.</p>
                <div class="list-group list-group-flush small">
                    <a href="<?= url('analytics/gradestracking') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-pencil-square me-2 text-gold"></i>Grades Tracking (Class Record)</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/subjectperformance') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-bar-chart-line me-2 text-gold"></i>Subject Performance</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/progressreports') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-card-checklist me-2 text-gold"></i>Academic Progress Reports</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/failedincompletemonitoring') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-exclamation-triangle me-2 text-gold"></i>Failed / Incomplete Monitoring</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub-module 3 -->
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="bi bi-calendar-check text-marsu-burgundy fs-5"></i>
                <h6 class="mb-0 fw-bold text-marsu-burgundy">3. Attendance &amp; Engagement</h6>
            </div>
            <div class="card-body p-3">
                <p class="small text-muted mb-3">Daily and weekly class attendance, active classroom recitation participation, LMS activity metrics, and conduct logs.</p>
                <div class="list-group list-group-flush small">
                    <a href="<?= url('analytics/attendancerecords') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-person-check me-2 text-gold"></i>Attendance Records</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/participationtracking') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-chat-dots me-2 text-gold"></i>Participation Tracking</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/studentengagement') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-laptop me-2 text-gold"></i>Student Engagement</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    <a href="<?= url('analytics/behaviorrecords') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-clipboard-check me-2 text-gold"></i>Behavior Records</span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
