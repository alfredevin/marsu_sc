<?php
use Modules\Analytics\Support\Ui;
?>
<div class="row g-3">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold">New post</div>
            <form method="POST" action="<?= url($base . '/posts') ?>" enctype="multipart/form-data" class="card-body small">
                <?= csrf_field() ?>
                <div class="mb-2">
                    <label class="form-label mb-1">Type</label>
                    <select name="type" class="form-select form-select-sm"><option value="announcement">Announcement</option><option value="material">Material</option></select>
                </div>
                <div class="mb-2"><label class="form-label mb-1">Title</label><input type="text" name="title" maxlength="191" required class="form-control form-control-sm"></div>
                <div class="mb-2"><label class="form-label mb-1">Message</label><textarea name="body" rows="5" maxlength="10000" class="form-control form-control-sm"></textarea></div>
                <div class="mb-2">
                    <label class="form-label mb-1">Attachment (optional)</label>
                    <input type="file" name="attachment" class="form-control form-control-sm" accept=".pdf,.docx,.pptx,.xlsx,.png,.jpg,.jpeg">
                    <div class="form-text">PDF, DOCX, PPTX, XLSX, PNG or JPG, up to 10 MB.</div>
                </div>
                <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_pinned" value="1" id="pinNew"><label class="form-check-label" for="pinNew">Pin to top</label></div>
                <button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-send me-1"></i>Post to class</button>
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <?php if (empty($posts)): ?>
            <div class="card border-0 shadow-sm"><?= Ui::emptyState('Nothing posted yet', 'Announcements and materials you post here are visible to students on the roster.', 'bi-megaphone') ?></div>
        <?php endif; ?>
        <?php foreach ($posts as $p): ?>
            <div class="card border-0 shadow-sm mb-2">
                <div class="card-body small">
                    <div class="d-flex justify-content-between gap-2">
                        <div>
                            <?php if ($p['is_pinned']): ?><i class="bi bi-pin-angle-fill text-marsu-burgundy me-1" title="Pinned"></i><?php endif; ?>
                            <span class="badge <?= $p['type'] === 'material' ? 'bg-info text-dark' : 'bg-secondary' ?>"><?= e(ucfirst($p['type'])) ?></span>
                            <span class="fw-semibold ms-1"><?= e($p['title']) ?></span>
                            <div class="text-secondary"><?= e($p['author'] ?? '') ?> · <?= e(date('M j, Y g:i A', strtotime($p['created_at']))) ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <form method="POST" action="<?= url($base . '/posts/' . (int) $p['id'] . '/pin') ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-secondary" type="submit" title="<?= $p['is_pinned'] ? 'Unpin' : 'Pin' ?>"><i class="bi bi-pin"></i></button></form>
                            <form method="POST" action="<?= url($base . '/posts/' . (int) $p['id'] . '/delete') ?>" data-confirm="Remove this post from the class stream?"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" type="submit" title="Delete"><i class="bi bi-trash"></i></button></form>
                        </div>
                    </div>
                    <?php if ($p['body']): ?><div class="mt-2" style="white-space:pre-wrap"><?= e($p['body']) ?></div><?php endif; ?>
                    <?php if ($p['attachment_path']): ?>
                        <a class="d-inline-block mt-2" href="<?= url('analytics/classes/' . $classId . '/posts/' . (int) $p['id'] . '/file') ?>"><i class="bi bi-paperclip me-1"></i><?= e($p['attachment_name']) ?></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
