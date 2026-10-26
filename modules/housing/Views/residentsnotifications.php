<!-- Residents Notifications View -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-bell-fill me-2 text-gold"></i>Resident Notification Logs & Broadcasts
        </h1>
        <p class="text-muted small mb-0">Broadcast emergency notices, curfew advisories, inspection alerts, and payment reminders via SMS & Portal to student residents.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Logs
        </button>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newBroadcastModal">
            <i class="bi bi-broadcast me-1"></i>New Resident Broadcast
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/announcements') ?>">
                <i class="bi bi-megaphone me-1"></i>Announcements
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/residentsnotifications') ?>">
                <i class="bi bi-bell me-1"></i>Notifications
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/rulesandpolicies') ?>">
                <i class="bi bi-shield-check me-1"></i>Rules & Policies
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/incidentreporting') ?>">
                <i class="bi bi-exclamation-triangle me-1"></i>Incident Reporting
            </a>
        </li>
    </ul>
</div>

<!-- Notification KPI Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Active Notices</div>
            <div class="h3 font-weight-bold mb-0 text-gold">8 Dispatched</div>
            <div class="small text-muted mt-1">Sent within the last 30 days</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">SMS Delivery Rate</div>
            <div class="h3 font-weight-bold mb-0 text-success">98.5%</div>
            <div class="small text-muted mt-1">Telco gateway confirmed</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Overdue Reminders</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">14 Alerts</div>
            <div class="small text-muted mt-1">Automated balance notices</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-warning p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Safety / Curfew Advisories</div>
            <div class="h3 font-weight-bold mb-0 text-warning">4 Alerts</div>
            <div class="small text-muted mt-1">Weather & campus protocol</div>
        </div>
    </div>
</div>

<!-- Recent Notification Dispatches -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-chat-left-text me-2 text-gold"></i>Broadcast Dispatch History
        </h6>
        <div class="input-group input-group-sm" style="width: 250px;">
            <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control border-start-0 ps-0" placeholder="Filter notifications...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Notice Subject</th>
                        <th>Target Audience</th>
                        <th>Channel</th>
                        <th>Dispatched Date</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Quarterly Fire & Earthquake Drill Notification</div>
                            <small class="text-muted">OSAS mandatory safety inspection advisory for all residents</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">All Accredited Boarders</span></td>
                        <td><span class="badge badge-gold"><i class="bi bi-chat-dots me-1"></i>SMS & Portal</span></td>
                        <td class="small text-muted"><?= date('M d, Y') ?> 09:30 AM</td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-all me-1"></i>Delivered (100%)</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary" title="View Recipients"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Scheduled Water Line Maintenance & Tank Disinfection</div>
                            <small class="text-muted">Water pressure interruption from 1:00 PM to 4:00 PM</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">Villa Marinduque Residents</span></td>
                        <td><span class="badge badge-gold"><i class="bi bi-chat-dots me-1"></i>SMS Alert</span></td>
                        <td class="small text-muted"><?= date('M d, Y', strtotime('-2 days')) ?> 08:15 AM</td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-all me-1"></i>Delivered (98%)</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary" title="View Recipients"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">Midterm Examination Quiet Hours Implementation</div>
                            <small class="text-muted">Strict noise curfew starting at 8:00 PM for all dormitories</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">All Accredited Boarders</span></td>
                        <td><span class="badge badge-gold"><i class="bi bi-app-indicator me-1"></i>Portal Notice</span></td>
                        <td class="small text-muted"><?= date('M d, Y', strtotime('-5 days')) ?> 04:00 PM</td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-all me-1"></i>Delivered</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary" title="View Recipients"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: New Resident Broadcast -->
<div class="modal fade" id="newBroadcastModal" tabindex="-1" aria-labelledby="newBroadcastModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newBroadcastModalLabel">
                    <i class="bi bi-broadcast me-2 text-gold"></i>Broadcast Resident Notification
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="event.preventDefault(); alert('Broadcast notification successfully queued for dispatch!'); bootstrap.Modal.getInstance(document.getElementById('newBroadcastModal')).hide();">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notification Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" required placeholder="e.g. Curfew Reminder: Typhoon Signal #1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Recipient Group <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" required>
                            <option value="All" selected>All Accredited Residents (All Dorms)</option>
                            <option value="Villa Marinduque">Villa Marinduque Dorm Residents</option>
                            <option value="Greenview">Greenview Boarding House</option>
                            <option value="Sunrise">Sunrise Ladies Dormitory</option>
                            <option value="Overdue">Residents with Overdue Balances</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Broadcast Channels</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chPortal" checked>
                                <label class="form-check-label small" for="chPortal">Student ERP Portal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chSms" checked>
                                <label class="form-check-label small" for="chSms">SMS Text Blast</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Message Content <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" rows="4" required placeholder="Type the announcement or advisory details here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-send-fill me-1"></i>Dispatch Broadcast
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
