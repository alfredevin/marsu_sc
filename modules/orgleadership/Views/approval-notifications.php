<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h1 class="h4 mb-1"><i class="bi bi-bell-fill text-marsu-burgundy me-2"></i><?= e($title) ?></h1>
            <p class="text-muted mb-0">Pending approvals and decisions recorded during the last 30 days.</p>
        </div>
        <a class="btn btn-outline-secondary" href="<?= e(url('orgleadership/event-approvals')) ?>"><i class="bi bi-check2-square me-1"></i>Manage approvals</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th>Proposal</th><th>Organization</th><th>Approval step</th><th>Decision</th><th>Updated</th><th>Comments</th></tr></thead>
                <tbody>
                <?php if (!$notifications): ?>
                    <tr><td colspan="6" class="text-center text-muted py-5"><i class="bi bi-check-circle d-block fs-3 mb-2"></i>No recent approval notifications.</td></tr>
                <?php endif; ?>
                <?php foreach ($notifications as $notification): ?>
                    <?php $decision = $notification['decision']; ?>
                    <tr>
                        <td><a class="fw-semibold text-decoration-none" href="<?= e(url('orgleadership/event-approvals')) ?>"><?= e($notification['activity_title']) ?></a><span class="d-block small text-muted">Proposal #<?= (int)$notification['proposal_id'] ?></span></td>
                        <td><?= e($notification['organization_name'] ?? 'Organization') ?><span class="d-block small text-muted"><?= e($notification['organization_acronym'] ?? '') ?></span></td>
                        <td><?= (int)$notification['approval_step'] ?></td>
                        <td><span class="badge <?= $decision === 'Approved' ? 'bg-success' : ($decision === 'Rejected' ? 'bg-danger' : ($decision === 'Pending' ? 'bg-warning text-dark' : 'bg-info text-dark')) ?>"><?= e($decision) ?></span></td>
                        <td><?= e(date('M j, Y g:i A', strtotime($notification['decision_at'] ?: $notification['created_at']))) ?></td>
                        <td class="small text-muted" style="max-width:320px"><?= e($notification['comments'] ?? '—') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
