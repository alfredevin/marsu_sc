<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h1 class="h4 mb-1"><i class="bi bi-bell text-marsu-burgundy me-2"></i><?= e($title) ?></h1>
            <p class="text-muted mb-0">Upcoming scheduled activities in the next 30 days.</p>
        </div>
        <a class="btn btn-outline-secondary" href="<?= e(url('orgleadership/activity-calendar')) ?>"><i class="bi bi-calendar3 me-1"></i>Open activity calendar</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th>Activity</th><th>Organization</th><th>When</th><th>Venue</th><th>Status</th><th class="text-end">Starts in</th></tr></thead>
                <tbody>
                <?php if (!$reminders): ?>
                    <tr><td colspan="6" class="text-center text-muted py-5"><i class="bi bi-calendar-check d-block fs-3 mb-2"></i>No upcoming activities need a reminder.</td></tr>
                <?php endif; ?>
                <?php foreach ($reminders as $reminder): ?>
                    <?php $daysUntil = max(0, (int)(new \DateTime('today'))->diff(new \DateTime($reminder['start_datetime']))->format('%r%a')); ?>
                    <tr>
                        <td><strong><?= e($reminder['activity_title']) ?></strong></td>
                        <td><?= e($reminder['organization_name']) ?> <span class="text-muted small"><?= e($reminder['organization_acronym']) ?></span></td>
                        <td><?= e(date('M j, Y', strtotime($reminder['start_datetime']))) ?><span class="d-block small text-muted"><?= e(date('g:i A', strtotime($reminder['start_datetime']))) ?><?= !empty($reminder['end_datetime']) ? '–' . e(date('g:i A', strtotime($reminder['end_datetime']))) : '' ?></span></td>
                        <td><?= e($reminder['venue_name'] ?? 'Venue not assigned') ?></td>
                        <td><span class="badge <?= $reminder['status'] === 'Ongoing' ? 'bg-primary' : 'bg-info text-dark' ?>"><?= e($reminder['status']) ?></span></td>
                        <td class="text-end"><span class="badge text-bg-light border"><?= $daysUntil === 0 ? 'Today' : ($daysUntil === 1 ? 'Tomorrow' : $daysUntil . ' days') ?></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
