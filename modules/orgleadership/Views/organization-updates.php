<div class="container-fluid py-3">
    <div class="mb-3">
        <h1 class="h4 mb-1"><i class="bi bi-arrow-repeat text-marsu-burgundy me-2"></i><?= e($title) ?></h1>
        <p class="text-muted mb-0">Latest published organization and campus announcements.</p>
    </div>
    <?php if (!$updates): ?>
        <div class="card border-0 shadow-sm"><div class="card-body text-center text-muted py-5"><i class="bi bi-inbox fs-2 d-block mb-2"></i>No published organization updates yet.</div></div>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($updates as $update): ?>
                <div class="col-12">
                    <article class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-2">
                                <div><h2 class="h5 mb-1"><?= e($update['title']) ?></h2><span class="badge text-bg-light border"><?= e($update['organization_name'] ?? 'Campus-wide') ?></span></div>
                                <time class="small text-muted" datetime="<?= e(date(DATE_ATOM, strtotime($update['published_at']))) ?>"><?= e(date('M j, Y g:i A', strtotime($update['published_at']))) ?></time>
                            </div>
                            <p class="mb-3" style="white-space:pre-line"><?= e($update['message']) ?></p>
                            <div class="small text-muted"><i class="bi bi-person-circle me-1"></i><?= e(trim(($update['publisher_first_name'] ?? '') . ' ' . ($update['publisher_last_name'] ?? '')) ?: 'Organization representative') ?></div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
