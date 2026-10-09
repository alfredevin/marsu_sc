<!-- Incident Reporting View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-shield-exclamation me-2 text-gold"></i>Student Incident & Grievance Reporting Desk
        </h1>
        <p class="text-muted small mb-0">Confidential intake for dormitory security infractions, noise complaints, roommate conflicts, and landlord disputes.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newIncidentModal">
            <i class="bi bi-plus-lg me-1"></i>File Incident Report
        </button>
    </div>
</div>

<!-- Notice on RA 10173 Privacy -->
<div class="alert alert-info border-info-subtle shadow-sm mb-4 small">
    <i class="bi bi-shield-lock-fill me-2 fs-6"></i>
    <strong>Data Privacy Act Compliance (RA 10173):</strong> All incident reports and sensitive student statements are handled with strict confidentiality by the OSAS Student Housing Desk and Prefect of Discipline.
</div>

<!-- Incidents Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-journal-x me-2 text-gold"></i>Incident Incident Logs & Action Taken
        </h6>
        <span class="badge bg-warning-subtle text-dark border border-warning">1 Case Under Mediation</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Case ID</th>
                        <th>Facility & Room</th>
                        <th>Incident Category</th>
                        <th>Incident Date</th>
                        <th>Case Severity</th>
                        <th>Resolution Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">INC-2026-008</td>
                        <td>Greenview Boarding House</td>
                        <td>Noise Curfew Violation (Late night party)</td>
                        <td>Oct 03, 2026 (11:45 PM)</td>
                        <td><span class="badge bg-warning text-dark">Medium</span></td>
                        <td><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>First Warning Issued</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i> View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">INC-2026-009</td>
                        <td>Villa Marinduque Dorm</td>
                        <td>Roommate Conflict / Shared Space Hygiene</td>
                        <td>Oct 06, 2026</td>
                        <td><span class="badge bg-info text-dark">Low</span></td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning"><i class="bi bi-hourglass-split me-1"></i>Scheduled for Mediation</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i> View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal File Incident -->
<div class="modal fade" id="newIncidentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">File Confidential Incident Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Boarding House Facility</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque Student Dorm</option>
                            <option>Greenview Boarding House</option>
                            <option>Sunrise Ladies Dormitory</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nature of Incident</label>
                        <select class="form-select">
                            <option value="noise">Curfew / Noise Disturbance</option>
                            <option value="roommate">Roommate Conflict / Harassment</option>
                            <option value="security">Theft / Unauthorized Entry</option>
                            <option value="safety">Fire Hazard / Unsafe Building Defect</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Date & Time of Incident</label>
                        <input type="datetime-local" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Narrative Statement of Facts</label>
                        <textarea class="form-control" rows="4" placeholder="Detail the events that occurred..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Submit Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
