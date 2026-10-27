<!-- Announcements View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-megaphone-fill me-2 text-gold"></i>Student Resident Bulletins & Announcements
        </h1>
        <p class="text-muted small mb-0">Broadcast university housing advisories, power interruption notices, water maintenance, and OSAS dorm inspection schedules.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/residentsnotifications') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-bell me-1"></i>Direct Notifications
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newAnnouncementModal">
            <i class="bi bi-plus-lg me-1"></i>Post Bulletin
        </button>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/announcements') ?>">
                <i class="bi bi-megaphone me-1 text-gold"></i>Announcements
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/residentsnotifications') ?>">
                <i class="bi bi-bell me-1"></i>Notifications
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/rulesandpolicies') ?>">
                <i class="bi bi-shield-check me-1"></i>Rules & Policies
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/incidentreporting') ?>">
                <i class="bi bi-exclamation-triangle me-1"></i>Incident Reporting
            </a>
        </li>
    </ul>
</div>

<!-- Bulletin Feed -->
<div class="row g-4 mb-4">
    <?php if (empty($announcements)): ?>
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 text-center text-muted">
                <i class="bi bi-megaphone fs-1 d-block mb-2 text-gold"></i>
                <h5>No Announcements Published Yet</h5>
                <p class="small mb-0">Click "Post Bulletin" to broadcast notices, inspection reminders, or curfew alerts to all students.</p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($announcements as $a): ?>
            <?php 
                $badgeClass = ($a['priority'] === 'Urgent') ? 'bg-danger' : (($a['priority'] === 'Important') ? 'bg-warning text-dark' : 'bg-primary');
            ?>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 <?= !empty($a['pinned']) ? 'border-top border-3 border-danger' : '' ?>">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge <?= $badgeClass ?> me-1"><?= e($a['category']) ?></span>
                            <?php if (!empty($a['pinned'])): ?>
                                <span class="badge bg-danger-subtle text-danger border border-danger"><i class="bi bi-pin-angle-fill me-1"></i>Pinned</span>
                            <?php endif; ?>
                        </div>
                        <small class="text-muted"><i class="bi bi-clock me-1"></i><?= date('M d, Y', strtotime($a['created_at'])) ?></small>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold text-marsu-burgundy"><?= e($a['title']) ?></h5>
                        <p class="text-muted small mb-3">
                            <?= nl2br(e($a['content'])) ?>
                        </p>
                        <div class="small text-secondary">
                            <strong>Target Audience:</strong> <?= e($a['target_audience'] ?? 'All Residents') ?>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 py-2 d-flex justify-content-between align-items-center">
                        <span class="small text-muted">Author: <?= e($a['published_by'] ?? 'Housing Desk') ?></span>
                        <form action="<?= url('housing/announcements/delete') ?>" method="POST" class="d-inline" onsubmit="return confirm('Delete this announcement bulletin?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" title="Remove Bulletin">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal Post Announcement -->
<div class="modal fade" id="newAnnouncementModal" tabindex="-1" aria-labelledby="newAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title font-weight-bold" id="newAnnouncementModalLabel">
                    <i class="bi bi-megaphone-fill me-2 text-gold"></i>Post Resident Housing Bulletin
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/announcements/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Bulletin Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm" placeholder="e.g. MARELCO Scheduled Power Interruption in Boac" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Category</label>
                            <select name="category" class="form-select form-select-sm">
                                <option value="General Notice">General Notice</option>
                                <option value="Safety Advisory">Safety Advisory</option>
                                <option value="Curfew Reminder">Curfew Reminder</option>
                                <option value="Water/Power Interruption">Water/Power Interruption</option>
                                <option value="Inspection Schedule">Inspection Schedule</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Priority Urgency</label>
                            <select name="priority" class="form-select form-select-sm">
                                <option value="Normal">Normal</option>
                                <option value="Important" selected>Important</option>
                                <option value="Urgent">Urgent / Critical</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Target Audience</label>
                            <input type="text" name="target_audience" class="form-control form-control-sm" value="All Residents & Landlords">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="pinned" value="1" id="pinnedCheck">
                                <label class="form-check-label small fw-bold" for="pinnedCheck">
                                    Pin to Top
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Announcement Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control form-control-sm" rows="4" placeholder="Write bulletin details, dates, affected boarding houses, and safety guidelines..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-send-fill me-1"></i>Broadcast Bulletin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
