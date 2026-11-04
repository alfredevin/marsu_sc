<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header(Ui::fullName($e), $e['student_number'] . ' · ' . $e['term_label'], 'bi-card-list') ?>
    <?= Ui::privacyNotice() ?>
    <div class="alert alert-light border small"><i class="bi bi-info-circle me-1"></i>This record is a copy from the official enrollment system. Changes to the enrollment are made there and synced by importing the updated list.</div>
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body small">
                    <dl class="row mb-0">
                        <dt class="col-4">Status</dt><dd class="col-8"><?= Ui::enrollmentBadge($e['status']) ?> <?= e($e['remarks'] ?? '') ?></dd>
                        <dt class="col-4">Program / year</dt><dd class="col-8"><?= e($e['program_code']) ?> · <?= (int) $e['year_level'] ?></dd>
                        <dt class="col-4">Section</dt><dd class="col-8"><?= e($e['section_name'] ?? '—') ?></dd>
                        <dt class="col-4">Imported</dt><dd class="col-8"><?= e($e['created_at'] ?? '—') ?> <?= $e['enrolled_by_name'] ? 'by ' . e($e['enrolled_by_name']) : '' ?></dd>
                        <dt class="col-4">Login account</dt><dd class="col-8"><?= $e['user_id'] ? 'Linked' : '<span class="text-danger">Not linked — create it in core User Accounts</span>' ?></dd>
                    </dl>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-transparent fw-semibold">Subject load</div>
                <table class="table table-sm mb-0 small"><thead class="table-light"><tr><th>Code</th><th>Title</th><th class="text-center">Units</th><th>Status</th></tr></thead>
                    <tbody><?php foreach ($e['subjects'] as $s): ?><tr class="<?= $s['status'] === 'dropped' ? 'text-secondary' : '' ?>"><td><?= e($s['code']) ?></td><td><?= e($s['title']) ?></td><td class="text-center"><?= e((string) $s['units']) ?></td><td><?= e($s['status']) ?></td></tr><?php endforeach; ?></tbody></table>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">History</div>
                <ul class="list-group list-group-flush small">
                    <?php foreach ($history as $h): ?><li class="list-group-item"><?= e(date('M j, Y g:i A', strtotime($h['created_at']))) ?> · <?= e($h['action']) ?> <?= e(($h['old_value'] ?? '') . ' → ' . ($h['new_value'] ?? '')) ?> <span class="text-secondary"><?= e($h['reason'] ?? '') ?> — <?= e($h['user_name'] ?? '') ?></span></li><?php endforeach; ?>
                    <?php if (!$history): ?><li class="list-group-item text-secondary">No history.</li><?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
