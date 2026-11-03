<?php
use Modules\Analytics\Support\Ui;

$hideTerm = true;
$statusSel = (string) ($_GET['status'] ?? '');
$sevSel = (string) ($_GET['severity'] ?? '');
ob_start(); ?>
<div class="col-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Status</label>
    <select name="status" class="form-select form-select-sm">
        <option value="">Any</option>
        <?php foreach (['Reported', 'Investigating', 'Resolved', 'Dismissed'] as $s): ?><option <?= $statusSel === $s ? 'selected' : '' ?>><?= $s ?></option><?php endforeach; ?>
    </select>
</div>
<div class="col-6 col-lg-2">
    <label class="form-label small text-secondary mb-1">Severity</label>
    <select name="severity" class="form-select form-select-sm">
        <option value="">Any</option>
        <?php foreach (['Minor', 'Moderate', 'Severe'] as $s): ?><option <?= $sevSel === $s ? 'selected' : '' ?>><?= $s ?></option><?php endforeach; ?>
    </select>
</div>
<?php $filterExtra = ob_get_clean();
$exportUrl = url('analytics/export/behavior', $filters);
$term = null;
$canManage = can('analytics.admin.conduct');
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Behavior Records', 'Conduct incidents reported by faculty.', 'bi-clipboard-check') ?>
    <?= Ui::privacyNotice() ?>
    <?php include __DIR__ . '/partials/filter_bar.php'; ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No conduct incidents', 'No incidents match these filters.', 'bi-shield-check') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm align-middle mb-0 small">
                <thead class="table-light"><tr><th>Date</th><th>Student</th><th>Incident</th><th>Severity</th><th>Status</th><th>Reported by</th><?php if ($canManage): ?><th>Manage</th><?php endif; ?></tr></thead>
                <tbody><?php foreach ($rows as $r): ?>
                    <tr>
                        <td><?= e($r['incident_date']) ?></td>
                        <td><a href="<?= url('analytics/students/' . (int) $r['student_id']) ?>" class="text-decoration-none fw-semibold"><?= e($r['last_name'] . ', ' . $r['first_name']) ?></a><div class="text-secondary"><?= e($r['student_number']) ?> · <?= e($r['program_code']) ?></div></td>
                        <td><?= e($r['incident_type']) ?><div class="text-secondary"><?= e($r['description']) ?></div><?php if ($r['resolution_notes']): ?><div class="text-success">Resolution: <?= e($r['resolution_notes']) ?></div><?php endif; ?></td>
                        <td><?= e($r['severity']) ?></td>
                        <td><?= e($r['status']) ?></td>
                        <td><?= e($r['reporter'] ?? '—') ?><div class="text-secondary"><?= e($r['subject_code'] ?? '') ?></div></td>
                        <?php if ($canManage): ?>
                            <td style="min-width:260px">
                                <form method="POST" action="<?= url('analytics/admin/conduct/' . (int) $r['id'] . '/status') ?>" class="d-flex gap-1 mb-1">
                                    <?= csrf_field() ?>
                                    <select name="status" class="form-select form-select-sm" style="width:130px">
                                        <?php foreach (['Reported', 'Investigating', 'Resolved', 'Dismissed'] as $s): ?><option <?= $r['status'] === $s ? 'selected' : '' ?>><?= $s ?></option><?php endforeach; ?>
                                    </select>
                                    <input type="text" name="resolution_notes" class="form-control form-control-sm" placeholder="Notes">
                                    <button class="btn btn-sm btn-outline-secondary" type="submit">Save</button>
                                </form>
                                <form method="POST" action="<?= url('analytics/admin/conduct/' . (int) $r['id'] . '/severity') ?>" class="d-flex gap-1">
                                    <?= csrf_field() ?>
                                    <select name="severity" class="form-select form-select-sm" style="width:130px">
                                        <?php foreach (['Minor', 'Moderate', 'Severe'] as $s): ?><option <?= $r['severity'] === $s ? 'selected' : '' ?>><?= $s ?></option><?php endforeach; ?>
                                    </select>
                                    <input type="text" name="reason" minlength="10" required class="form-control form-control-sm" placeholder="Reason (min 10)">
                                    <button class="btn btn-sm btn-outline-secondary" type="submit">Reclassify</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>
