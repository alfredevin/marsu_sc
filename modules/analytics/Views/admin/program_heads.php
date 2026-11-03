<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Program Heads', 'A Program Head sees only the students, classes and reports of the programs mapped here.', 'bi-diagram-3') ?>
    <div class="row g-3">
        <div class="col-lg-4">
            <form method="POST" action="<?= url('analytics/admin/program-heads/store') ?>" class="card border-0 shadow-sm">
                <?= csrf_field() ?>
                <div class="card-header bg-transparent fw-semibold">Map a program</div>
                <div class="card-body small">
                    <?php if (empty($heads)): ?>
                        <p class="text-secondary mb-0">No users have the Program Head role. Assign the role in core User Accounts first.</p>
                    <?php else: ?>
                        <label class="form-label mb-1">Program Head</label>
                        <select name="user_id" class="form-select form-select-sm mb-2" required>
                            <?php foreach ($heads as $h): ?><option value="<?= (int) $h['id'] ?>"><?= e($h['full_name'] . ' (' . $h['username'] . ')') ?></option><?php endforeach; ?>
                        </select>
                        <label class="form-label mb-1">Program</label>
                        <select name="program_id" class="form-select form-select-sm mb-3" required>
                            <?php foreach ($programs as $p): ?><option value="<?= (int) $p['id'] ?>"><?= e($p['code'] . ' — ' . $p['name']) ?></option><?php endforeach; ?>
                        </select>
                        <button class="btn btn-sm btn-marsu" type="submit">Add mapping</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">Current mappings</div>
                <?php if (empty($mappings)): ?>
                    <?= Ui::emptyState('No mappings', 'Program Heads without a mapping see no data.', 'bi-diagram-3') ?>
                <?php else: ?>
                    <table class="table table-sm align-middle mb-0 small">
                        <thead class="table-light"><tr><th>Program Head</th><th>Program</th><th>Since</th><th></th></tr></thead>
                        <tbody><?php foreach ($mappings as $m): ?>
                            <tr><td><?= e($m['full_name']) ?> <span class="text-secondary"><?= e($m['username']) ?></span></td><td><?= e($m['code']) ?> <span class="text-secondary"><?= e($m['program_name']) ?></span></td>
                                <td><?= e(date('M j, Y', strtotime($m['created_at']))) ?></td>
                                <td class="text-end"><form method="POST" action="<?= url('analytics/admin/program-heads/' . (int) $m['id'] . '/delete') ?>" data-confirm="Remove this program mapping?"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash"></i></button></form></td></tr>
                        <?php endforeach; ?></tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= Ui::confirmScript() ?>
