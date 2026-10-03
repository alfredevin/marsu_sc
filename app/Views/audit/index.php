<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">System Audit Trail</h1>
        <p class="text-muted small mb-0">Immutable compliance log recording all sensitive system events, logins, and entity modifications.</p>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <form method="GET" action="<?= url('audit') ?>" class="row g-2 align-items-center">
            <?php if (isset($_GET['r'])): ?>
                <input type="hidden" name="r" value="audit">
            <?php endif; ?>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Search by user, action, entity, IP..." value="<?= e($search) ?>">
                </div>
            </div>
            <div class="col-md-4">
                <select name="action" class="form-select form-select-sm">
                    <option value="">All Action Types</option>
                    <option value="auth" <?= ($actionFilter === 'auth') ? 'selected' : '' ?>>Authentication Events</option>
                    <option value="student" <?= ($actionFilter === 'student') ? 'selected' : '' ?>>Student Modifications</option>
                    <option value="employee" <?= ($actionFilter === 'employee') ? 'selected' : '' ?>>Employee Modifications</option>
                    <option value="role" <?= ($actionFilter === 'role') ? 'selected' : '' ?>>RBAC Changes</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-marsu btn-sm w-100"><i class="bi bi-filter me-1"></i>Filter</button>
                <a href="<?= url('audit') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i></a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-clock-history me-2"></i>Audit Logs</h6>
        <span class="badge badge-burgundy"><?= number_format($pagination['total']) ?> Entries</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Timestamp</th>
                        <th>Responsible User</th>
                        <th>Event Action</th>
                        <th>Target Entity</th>
                        <th>IP Address</th>
                        <th>Payload Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">No audit logs recorded for this query.</td></tr>
                    <?php else: ?>
                        <?php foreach ($logs as $index => $log): ?>
                            <tr>
                                <td><?= ($pagination['current_page'] - 1) * $pagination['per_page'] + $index + 1 ?></td>
                                <td class="text-nowrap text-muted"><?= date('M j, Y h:i:s A', strtotime($log['created_at'])) ?></td>
                                <td>
                                    <?php if (!empty($log['username'])): ?>
                                        <strong><?= e($log['first_name'] . ' ' . $log['last_name']) ?></strong>
                                        <div class="text-muted" style="font-size:0.75rem;">@<?= e($log['username']) ?></div>
                                    <?php else: ?>
                                        <span class="text-muted">System / Anonymous</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-burgundy"><?= e($log['action']) ?></span></td>
                                <td><code><?= e($log['entity']) ?><?= $log['entity_id'] ? ' #' . $log['entity_id'] : '' ?></code></td>
                                <td class="font-monospace text-muted"><?= e($log['ip_address']) ?></td>
                                <td>
                                    <?php if (!empty($log['details'])): ?>
                                        <button class="btn btn-sm btn-outline-secondary py-0 px-2" style="font-size: 0.75rem;" 
                                                onclick='showDetails(<?= json_encode($log['details']) ?>, "<?= e($log['action']) ?>")'>
                                            <i class="bi bi-code-slash me-1"></i>View JSON
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 0.75rem;">None</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($pagination['last_page'] > 1): ?>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2 flex-wrap gap-2">
            <span class="small text-muted">Page <?= $pagination['current_page'] ?> of <?= $pagination['last_page'] ?></span>
            <?= render_pagination($pagination, 'audit', $_GET) ?>
        </div>
    <?php endif; ?>
</div>

<!-- Modal: JSON Details -->
<div class="modal fade" id="auditDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy" id="modalActionTitle">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <pre id="auditJsonPayload" class="bg-dark text-warning p-3 rounded small mb-0 font-monospace" style="max-height: 400px; overflow-y: auto;"></pre>
            </div>
        </div>
    </div>
</div>

<script>
function showDetails(rawJson, action) {
    document.getElementById('modalActionTitle').textContent = 'Payload: ' + action;
    try {
        const obj = JSON.parse(rawJson);
        document.getElementById('auditJsonPayload').textContent = JSON.stringify(obj, null, 2);
    } catch(e) {
        document.getElementById('auditJsonPayload').textContent = rawJson;
    }
    new bootstrap.Modal(document.getElementById('auditDetailModal')).show();
}
</script>
