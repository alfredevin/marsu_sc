<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('My Conduct Records', 'Date, type, severity and status of reports filed about you.', 'bi-flag') ?>
    <?= Ui::privacyNotice() ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No conduct records', 'There are no conduct reports on file for you.', 'bi-shield-check') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table mb-0 small">
                <thead class="table-light"><tr><th>Date</th><th>Type</th><th>Severity</th><th>Status</th></tr></thead>
                <tbody><?php foreach ($rows as $r): ?>
                    <tr><td><?= e($r['incident_date']) ?></td><td><?= e($r['incident_type']) ?></td><td><?= e($r['severity']) ?></td><td><?= e($r['status']) ?></td></tr>
                <?php endforeach; ?></tbody>
            </table></div>
            <div class="card-footer bg-transparent small text-secondary">For details, please see the Guidance Office.</div>
        <?php endif; ?>
    </div>
</div>
