<!-- Service History View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-clock-history me-2 text-gold"></i>Facility Service & Preventative Maintenance Log
        </h1>
        <p class="text-muted small mb-0">Historical log of building pest control, water tank disinfection, air conditioning cleaning, and BFP fire safety servicing.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/conditionreports') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-clipboard2-check me-1"></i>Condition Reports
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newServiceModal">
            <i class="bi bi-plus-lg me-1"></i>Log Service Activity
        </button>
    </div>
</div>

<!-- Service History Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-tools me-2 text-gold"></i>Preventative Service Log Registry
        </h6>
        <span class="badge bg-light text-dark border">All Accredited Facilities</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Service Code</th>
                        <th>Facility</th>
                        <th>Service Category</th>
                        <th>Contractor / Service Provider</th>
                        <th>Cost (₱)</th>
                        <th>Date Completed</th>
                        <th class="text-end pe-3">Certification</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">SRV-2026-012</td>
                        <td>Villa Marinduque Dorm</td>
                        <td>Deep Well Water Tank Disinfection</td>
                        <td>Marinduque Water Hygiene Solutions</td>
                        <td>₱4,500.00</td>
                        <td>Aug 10, 2026</td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>Potable Certified</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">SRV-2026-013</td>
                        <td>Greenview Boarding House</td>
                        <td>General Pest & Termite Control</td>
                        <td>Island Pest Exterminators Boac</td>
                        <td>₱6,200.00</td>
                        <td>Aug 22, 2026</td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>DOH Cleared</span></td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">SRV-2026-014</td>
                        <td>Sunrise Ladies Dormitory</td>
                        <td>Fire Extinguisher Hydro-Testing & Refill</td>
                        <td>Boac Fire & Safety Supplies</td>
                        <td>₱3,800.00</td>
                        <td>Sep 01, 2026</td>
                        <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success"><i class="bi bi-check-circle me-1"></i>BFP Tagged</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Service Activity -->
<div class="modal fade" id="newServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Log Preventative Service Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facility Name</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque Student Dorm</option>
                            <option>Greenview Boarding House</option>
                            <option>Sunrise Ladies Dormitory</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Service Type</label>
                        <input type="text" class="form-control" placeholder="e.g. Septic Tank Siphoning / Tank Disinfection" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Contractor / Technician Name</label>
                        <input type="text" class="form-control" placeholder="e.g. Marinduque Hygiene Pros" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Date Completed</label>
                        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Record Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
