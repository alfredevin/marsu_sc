<!-- Waiting List View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-list-ol me-2 text-gold"></i>Housing Intake Waiting List Queue
        </h1>
        <p class="text-muted small mb-0">Prioritized queue of students waiting for vacancies in high-demand accredited dormitories based on date of application and proximity.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/reservationmanagement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-bookmarks me-1"></i>Reservations
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newWaitlistModal">
            <i class="bi bi-plus-lg me-1"></i>Add Student to Waitlist
        </button>
    </div>
</div>

<!-- Waitlist Queue Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-people me-2 text-gold"></i>Priority Waiting List Roster
        </h6>
        <span class="badge bg-warning-subtle text-dark border border-warning">4 Active in Queue</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 70px;">Queue #</th>
                        <th>Applicant Student</th>
                        <th>Preferred Facility & Room Type</th>
                        <th>Hometown / Province</th>
                        <th>Waitlist Date</th>
                        <th>Priority Rating</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-marsu-burgundy fs-5">01</td>
                        <td>
                            <div class="fw-bold text-dark">Janelle Marie Cruz</div>
                            <div class="small text-muted">ID: 24-0199 • 1st Year BS Bio</div>
                        </td>
                        <td>Villa Marinduque Dorm (Female 2-Pax)</td>
                        <td>Torrijos, Marinduque (Far South)</td>
                        <td>Sep 02, 2026</td>
                        <td><span class="badge bg-danger">High (Far Municipality)</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-success" title="Notify Vacancy"><i class="bi bi-bell-fill me-1"></i>Offer Bed</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-marsu-burgundy fs-5">02</td>
                        <td>
                            <div class="fw-bold text-dark">Arvin Patrick De Vera</div>
                            <div class="small text-muted">ID: 24-0310 • 1st Year BSCE</div>
                        </td>
                        <td>Greenview Boarding House (Male 2-Pax)</td>
                        <td>Buenavista, Marinduque</td>
                        <td>Sep 05, 2026</td>
                        <td><span class="badge bg-warning text-dark">Medium</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary" title="Notify Vacancy"><i class="bi bi-bell me-1"></i>Notify</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-marsu-burgundy fs-5">03</td>
                        <td>
                            <div class="fw-bold text-dark">Eunice Anne Manguerra</div>
                            <div class="small text-muted">ID: 24-0722 • 1st Year BSHM</div>
                        </td>
                        <td>Sunrise Ladies Dormitory (Female Single)</td>
                        <td>Santa Cruz, Marinduque</td>
                        <td>Sep 12, 2026</td>
                        <td><span class="badge bg-info text-dark">Normal</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary" title="Notify Vacancy"><i class="bi bi-bell me-1"></i>Notify</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Waitlist -->
<div class="modal fade" id="newWaitlistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Enqueue Student to Waitlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Student Name / ID</label>
                        <input type="text" class="form-control" placeholder="Search MarSU Student..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Preferred Boarding House</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque Student Dorm</option>
                            <option>Greenview Boarding House</option>
                            <option>Sunrise Ladies Dormitory</option>
                            <option>Any Available Accredited Facility</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hometown / Municipality</label>
                        <input type="text" class="form-control" placeholder="e.g. Torrijos / Gasan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Priority Level</label>
                        <select class="form-select">
                            <option value="high">High (Remote Island / Out of Province)</option>
                            <option value="medium">Medium (Far Municipality)</option>
                            <option value="normal">Normal</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Enqueue to Waitlist</button>
                </div>
            </form>
        </div>
    </div>
</div>
