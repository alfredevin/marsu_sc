<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h1 class="h4 mb-1"><i class="bi bi-megaphone-fill text-marsu-burgundy me-2"></i><?= e($title) ?></h1>
            <p class="text-muted mb-0">Create and manage announcements for the campus or an organization.</p>
        </div>
        <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
            <i class="bi bi-plus-lg me-1"></i>New announcement
        </button>
    </div>

    <form method="get" action="<?= e(url('orgleadership/announcements')) ?>" class="card card-body mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-sm-5 col-lg-4">
                <label class="form-label" for="announcement-org-filter">Organization</label>
                <select class="form-select" id="announcement-org-filter" name="organization_id">
                    <option value="0">All organizations</option>
                    <?php foreach ($organizations as $organization): ?>
                        <option value="<?= (int)$organization['id'] ?>" <?= (int)$organizationFilter === (int)$organization['id'] ? 'selected' : '' ?>><?= e($organization['name']) ?> (<?= e($organization['acronym']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-4 col-lg-3">
                <label class="form-label" for="announcement-status-filter">Status</label>
                <select class="form-select" id="announcement-status-filter" name="status">
                    <option value="">All statuses</option>
                    <?php foreach ($announcementStatuses as $status): ?>
                        <option value="<?= e($status) ?>" <?= $statusFilter === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto"><button class="btn btn-outline-secondary" type="submit"><i class="bi bi-funnel me-1"></i>Filter</button></div>
            <div class="col-auto"><a class="btn btn-link" href="<?= e(url('orgleadership/announcements')) ?>">Clear</a></div>
        </div>
    </form>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th>Announcement</th><th>Audience</th><th>Publisher</th><th>Published</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                <?php if (!$announcements): ?>
                    <tr><td colspan="6" class="text-center text-muted py-5"><i class="bi bi-megaphone d-block fs-3 mb-2"></i>No announcements match these filters.</td></tr>
                <?php endif; ?>
                <?php foreach ($announcements as $announcement): ?>
                    <?php $editModalId = 'editAnnouncement' . (int)$announcement['id']; ?>
                    <tr>
                        <td><strong><?= e($announcement['title']) ?></strong><div class="small text-muted text-truncate" style="max-width:420px"><?= e($announcement['message']) ?></div></td>
                        <td><?= e($announcement['organization_name'] ?? 'Campus-wide') ?></td>
                        <td><?= e(trim(($announcement['publisher_first_name'] ?? '') . ' ' . ($announcement['publisher_last_name'] ?? '')) ?: $announcement['published_by_student_id']) ?></td>
                        <td><?= e(date('M j, Y g:i A', strtotime($announcement['published_at']))) ?></td>
                        <td><span class="badge <?= $announcement['announcement_status'] === 'Published' ? 'bg-success' : ($announcement['announcement_status'] === 'Draft' ? 'bg-secondary' : 'bg-warning text-dark') ?>"><?= e($announcement['announcement_status']) ?></span></td>
                        <td class="text-end text-nowrap">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#<?= e($editModalId) ?>" aria-label="Edit announcement"><i class="bi bi-pencil-square"></i></button>
                            <form method="post" action="<?= e(url('orgleadership/announcements/delete')) ?>" class="d-inline" onsubmit="return confirm('Archive this announcement?')">
                                <?= csrf_field() ?><input type="hidden" name="announcement_id" value="<?= (int)$announcement['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Archive announcement"><i class="bi bi-archive"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($announcements as $announcement): ?>
<div class="modal fade" id="editAnnouncement<?= (int)$announcement['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content">
        <form method="post" action="<?= e(url('orgleadership/announcements/update')) ?>">
            <?= csrf_field() ?><input type="hidden" name="announcement_id" value="<?= (int)$announcement['id'] ?>">
            <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title fs-5">Edit announcement</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label" for="edit-ann-title-<?= (int)$announcement['id'] ?>">Title</label><input class="form-control" id="edit-ann-title-<?= (int)$announcement['id'] ?>" name="title" maxlength="180" required value="<?= e($announcement['title']) ?>"></div>
                <div class="mb-3"><label class="form-label" for="edit-ann-message-<?= (int)$announcement['id'] ?>">Message</label><textarea class="form-control" id="edit-ann-message-<?= (int)$announcement['id'] ?>" name="message" rows="5" required><?= e($announcement['message']) ?></textarea></div>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="edit-ann-org-<?= (int)$announcement['id'] ?>">Audience</label><select class="form-select" id="edit-ann-org-<?= (int)$announcement['id'] ?>" name="organization_id"><option value="0">Campus-wide</option><?php foreach ($organizations as $organization): ?><option value="<?= (int)$organization['id'] ?>" <?= (int)$announcement['organization_id'] === (int)$organization['id'] ? 'selected' : '' ?>><?= e($organization['name']) ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-6"><label class="form-label" for="edit-ann-publisher-<?= (int)$announcement['id'] ?>">Publisher</label><select class="form-select" id="edit-ann-publisher-<?= (int)$announcement['id'] ?>" name="published_by_student_id" required><option value="">Choose publisher</option><?php foreach ($students as $student): ?><option value="<?= e($student['student_number']) ?>" <?= $announcement['published_by_student_id'] === $student['student_number'] ? 'selected' : '' ?>><?= e($student['last_name'] . ', ' . $student['first_name'] . ' (' . $student['student_number'] . ')') ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-6"><label class="form-label" for="edit-ann-date-<?= (int)$announcement['id'] ?>">Publication date</label><input class="form-control" type="datetime-local" id="edit-ann-date-<?= (int)$announcement['id'] ?>" name="published_at" required value="<?= e(date('Y-m-d\\TH:i', strtotime($announcement['published_at']))) ?>"></div>
                    <div class="col-md-6"><label class="form-label" for="edit-ann-status-<?= (int)$announcement['id'] ?>">Status</label><select class="form-select" id="edit-ann-status-<?= (int)$announcement['id'] ?>" name="announcement_status"><?php foreach ($announcementStatuses as $status): ?><option value="<?= e($status) ?>" <?= $announcement['announcement_status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option><?php endforeach; ?></select></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-save me-1"></i>Save changes</button></div>
        </form>
    </div></div>
</div>
<?php endforeach; ?>

<div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content">
        <form method="post" action="<?= e(url('orgleadership/announcements/store')) ?>">
            <?= csrf_field() ?>
            <div class="modal-header bg-marsu-burgundy text-white"><h2 class="modal-title fs-5">New announcement</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label" for="announcement-title">Title</label><input class="form-control" id="announcement-title" name="title" maxlength="180" required></div>
                <div class="mb-3"><label class="form-label" for="announcement-message">Message</label><textarea class="form-control" id="announcement-message" name="message" rows="5" required></textarea></div>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="announcement-org">Audience</label><select class="form-select" id="announcement-org" name="organization_id"><option value="0">Campus-wide</option><?php foreach ($organizations as $organization): ?><option value="<?= (int)$organization['id'] ?>"><?= e($organization['name']) ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-6"><label class="form-label" for="announcement-publisher">Publisher</label><select class="form-select" id="announcement-publisher" name="published_by_student_id" required><option value="">Choose publisher</option><?php foreach ($students as $student): ?><option value="<?= e($student['student_number']) ?>"><?= e($student['last_name'] . ', ' . $student['first_name'] . ' (' . $student['student_number'] . ')') ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-6"><label class="form-label" for="announcement-date">Publication date</label><input class="form-control" type="datetime-local" id="announcement-date" name="published_at" required value="<?= e(date('Y-m-d\\TH:i')) ?>"></div>
                    <div class="col-md-6"><label class="form-label" for="announcement-status">Status</label><select class="form-select" id="announcement-status" name="announcement_status"><?php foreach ($announcementStatuses as $status): ?><option value="<?= e($status) ?>" <?= $status === 'Draft' ? 'selected' : '' ?>><?= e($status) ?></option><?php endforeach; ?></select></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-marsu" type="submit"><i class="bi bi-send me-1"></i>Save announcement</button></div>
        </form>
    </div></div>
</div>
