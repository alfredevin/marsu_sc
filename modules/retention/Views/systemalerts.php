<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-bell-fill me-1"></i> Automated Retention Risk Alerts & System Notifications
            </h6>
            <small class="text-muted">Real-time alerts triggered by grade entry, unexcused absence accumulation, and removal deadlines.</small>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-danger"><?= htmlspecialchars((string) ($criticalCount ?? 2)) ?> Critical Flags</span>
            <span class="badge bg-dark"><?= htmlspecialchars((string) ($totalAlerts ?? count($alertList ?? []))) ?> Total Alerts</span>
        </div>
    </div>

    <!-- Alert Cards Stream -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-rss-fill me-1"></i> System Notification Feed
            </h6>
            <span class="badge bg-danger-subtle text-danger border border-danger">Active Notifications Stream</span>
        </div>
        <div class="card-body p-3">
            <div class="list-group list-group-flush">
                <?php if (!empty($alertList)): ?>
                    <?php foreach ($alertList as $alert): ?>
                        <?php
                        $sev = $alert['severity'] ?? 'Moderate';
                        $badgeClass = 'bg-warning text-dark';
                        if ($sev === 'High' || $sev === 'Critical' || $sev === 'Severe') {
                            $badgeClass = 'bg-danger text-white';
                        } elseif ($sev === 'Low' || $sev === 'Minor') {
                            $badgeClass = 'bg-info text-dark';
                        }
                        $category = $alert['category'] ?? 'Academic Risk';
                        ?>
                        <div class="list-group-item p-3 border-bottom rounded-2 mb-2 bg-light">
                            <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($sev) ?> Priority</span>
                                    <span class="badge bg-secondary-subtle text-secondary border"><?= htmlspecialchars($category) ?></span>
                                    <h6 class="fw-bold mb-0 text-dark">Student #<?= htmlspecialchars($alert['student_id'] ?? 'N/A') ?></h6>
                                </div>
                                <small class="text-muted font-monospace"><?= htmlspecialchars($alert['created_at'] ?? date('Y-m-d H:i')) ?></small>
                            </div>
                            <p class="small text-secondary mb-2"><?= htmlspecialchars($alert['message'] ?? 'Risk indicator logged by system.') ?></p>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="profile?student_id=<?= urlencode($alert['student_id'] ?? '') ?>" class="btn btn-xs btn-outline-primary">
                                    <i class="bi bi-person me-1"></i> Student Dossier
                                </a>
                                <a href="guidancereferrals" class="btn btn-xs btn-outline-danger">
                                    <i class="bi bi-shield-exclamation me-1"></i> Guidance Referral
                                </a>
                                <a href="atriskstudents" class="btn btn-xs btn-outline-secondary">
                                    <i class="bi bi-flag me-1"></i> Watchlist
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-bell-slash fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No active risk alerts</p>
                        <small>All evaluated student records are currently compliant.</small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
