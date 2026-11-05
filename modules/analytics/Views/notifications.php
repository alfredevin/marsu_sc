<?php
use Modules\Analytics\Support\Ui;

$hasUnread = (bool) array_filter($rows, fn($r) => $r['read_at'] === null);
$actions = '';
if ($hasUnread) {
    $actions = '<form method="POST" action="' . e(url('analytics/notifications/read-all')) . '">' . csrf_field()
        . '<button class="btn btn-sm btn-outline-secondary" type="submit"><i class="bi bi-check2-all me-1"></i>Mark all read</button></form>';
}
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Notifications', 'Updates about grades, classes, join requests and enrollment.', 'bi-bell', $actions) ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No notifications', 'You are all caught up.', 'bi-bell-slash') ?>
        <?php else: ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($rows as $n): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start gap-2 <?= $n['read_at'] ? '' : 'bg-body-tertiary' ?>">
                        <div>
                            <div class="fw-semibold"><?= $n['read_at'] ? '' : '<span class="badge bg-danger me-1">New</span>' ?><?= e($n['title']) ?></div>
                            <?php if ($n['body']): ?><div class="small text-secondary"><?= e($n['body']) ?></div><?php endif; ?>
                            <div class="small text-secondary"><?= e(date('M j, Y g:i A', strtotime($n['created_at']))) ?></div>
                        </div>
                        <form method="POST" action="<?= url('analytics/notifications/' . (int) $n['id'] . '/read') ?>">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-secondary" type="submit"><?= $n['link'] ? 'Open' : 'Mark read' ?></button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
