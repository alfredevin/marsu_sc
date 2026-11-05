<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('INC Deficiencies', 'Incomplete grades you still need to complete.', 'bi-hourglass-split') ?>
    <?= Ui::privacyNotice() ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($incs)): ?>
            <?= Ui::emptyState('No incomplete grades', 'You have no open INC marks.', 'bi-check2-circle') ?>
        <?php else: ?>
            <ul class="list-group list-group-flush small">
                <?php foreach ($incs as $i): $days = $i['days_left'] === null ? null : (int) $i['days_left']; ?>
                    <li class="list-group-item d-flex flex-wrap justify-content-between gap-2">
                        <div><span class="fw-semibold"><?= e($i['subject_code']) ?></span> <?= e($i['subject_title']) ?><div class="text-secondary"><?= e($i['section_name']) ?> · <?= e($i['faculty_name'] ?? '') ?></div></div>
                        <div class="text-end">
                            <?php if ($days === null): ?>
                                <span class="text-secondary">Deadline not configured<?= $incWindow === null ? '' : '' ?></span>
                            <?php else: ?>
                                <div class="fw-semibold <?= $days < 0 ? 'text-danger' : ($days <= 30 ? 'text-warning-emphasis' : '') ?>"><?= $days < 0 ? abs($days) . ' day(s) overdue' : $days . ' day(s) left' ?></div>
                                <div class="text-secondary">Due <?= e($i['inc_deadline']) ?></div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
