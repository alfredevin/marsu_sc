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
    <!-- Announcement 1 -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <span class="badge bg-danger">MAINTENANCE ADVISORY</span>
                <small class="text-muted"><i class="bi bi-clock me-1"></i>Posted Today, 7:00 AM</small>
            </div>
            <div class="card-body">
                <h5 class="fw-bold text-marsu-burgundy">MARELCO Scheduled Power Interruption in Boac</h5>
                <p class="text-muted small">
                    Please be advised that MARELCO has scheduled a temporary power service interruption covering Poblacion and Santol on <strong>Saturday, October 17, 2026, from 8:00 AM to 5:00 PM</strong> for line rehabilitation. Landlords are advised to test backup generators and water pressure pumps.
                </p>
                <div class="small text-secondary">
                    <strong>Audience:</strong> All Boarding House Facilities • Boac Campus
                </div>
            </div>
            <div class="card-footer bg-light border-0 py-2 d-flex justify-content-between align-items-center">
                <span class="small text-muted">Author: MarSU OSAS Housing Desk</span>
                <span class="badge bg-success-subtle text-success border border-success">SMS Broadcasted</span>
            </div>
        </div>
    </div>

    <!-- Announcement 2 -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <span class="badge bg-primary">SEMESTRAL INSPECTION</span>
                <small class="text-muted"><i class="bi bi-clock me-1"></i>Oct 05, 2026</small>
            </div>
            <div class="card-body">
                <h5 class="fw-bold text-marsu-burgundy">Midterm Fire & Sanitation Audit Schedule</h5>
                <p class="text-muted small">
                    The University Student Services inspection committee together with BFP Boac will conduct random physical inspections for emergency exit readiness and fire extinguisher certification starting <strong>October 20, 2026</strong>.
                </p>
                <div class="small text-secondary">
                    <strong>Audience:</strong> Landlords & Student Boarders
                </div>
            </div>
            <div class="card-footer bg-light border-0 py-2 d-flex justify-content-between align-items-center">
                <span class="small text-muted">Author: OSAS Safety Division</span>
                <span class="badge bg-info-subtle text-info border border-info">Public Bulletin</span>
            </div>
        </div>
    </div>
</div>

<!-- Modal Post Announcement -->
<div class="modal fade" id="newAnnouncementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Post Resident Housing Bulletin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bulletin Title</label>
                        <input type="text" class="form-control" placeholder="e.g. Water Tank Maintenance Advisory" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category / Badge</label>
                        <select class="form-select">
                            <option value="advisory">Advisory / Power Interruption</option>
                            <option value="inspection">Safety / Inspection Schedule</option>
                            <option value="general">General University Memo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Announcement Content</label>
                        <textarea class="form-control" rows="4" placeholder="Write advisory text..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Broadcast Bulletin</button>
                </div>
            </form>
        </div>
    </div>
</div>
