<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Class Stream', 'Recent announcements and materials across all your classes. Post from a class page.', 'bi-megaphone') ?>
    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-semibold">Post to a class</div>
                <?php if (empty($classes)): ?>
                    <?= Ui::emptyState('No classes', 'Create a class first.', 'bi-collection', url('analytics/faculty/classes/create'), 'Create class') ?>
                <?php else: ?>
                    <div class="list-group list-group-flush small">
                        <?php foreach ($classes as $c): ?>
                            <a class="list-group-item list-group-item-action" href="<?= url('analytics/faculty/classes/' . (int) $c['id'] . '/classroom', ['tab' => 'stream']) ?>"><?= e($c['subject_code'] . ' — ' . $c['section_name']) ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-8">
            <?php if (empty($posts)): ?>
                <div class="card border-0 shadow-sm"><?= Ui::emptyState('Nothing posted yet', 'Open a class and use its Stream tab to post an announcement or material.', 'bi-megaphone') ?></div>
            <?php endif; ?>
            <?php foreach ($posts as $p): ?>
                <div class="card border-0 shadow-sm mb-2"><div class="card-body small">
                    <div class="d-flex justify-content-between gap-2">
                        <div>
                            <?php if ($p['is_pinned']): ?><i class="bi bi-pin-angle-fill me-1" title="Pinned"></i><?php endif; ?>
                            <span class="badge <?= $p['type'] === 'material' ? 'bg-info text-dark' : 'bg-secondary' ?>"><?= e(ucfirst($p['type'])) ?></span>
                            <span class="fw-semibold"><?= e($p['title']) ?></span>
                            <div class="text-secondary"><?= e($p['subject_code'] . ' · ' . $p['section_name']) ?> · <?= e(date('M j, Y g:i A', strtotime($p['created_at']))) ?></div>
                        </div>
                        <a class="btn btn-sm btn-outline-secondary align-self-start" href="<?= url('analytics/faculty/classes/' . (int) $p['class_id'] . '/classroom', ['tab' => 'stream']) ?>">Open</a>
                    </div>
                    <?php if ($p['body']): ?><div class="mt-2" style="white-space:pre-wrap"><?= e($p['body']) ?></div><?php endif; ?>
                    <?php if ($p['attachment_path']): ?><a class="d-inline-block mt-2" href="<?= url('analytics/classes/' . (int) $p['class_id'] . '/posts/' . (int) $p['id'] . '/file') ?>"><i class="bi bi-paperclip me-1"></i><?= e($p['attachment_name']) ?></a><?php endif; ?>
                </div></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
