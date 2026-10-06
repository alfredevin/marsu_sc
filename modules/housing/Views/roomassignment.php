<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 text-marsu-burgundy mb-1">
            <i class="bi bi-door-open me-2 text-gold"></i>Room Assignment
        </h1>
        <p class="text-muted mb-0">Review room placements and check available accommodation before assigning a student.</p>
    </div>
    <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Overview
    </a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h2 class="h5 text-marsu-burgundy mb-0">Current Room Assignments</h2>
        <a href="<?= url('housing/roomandinventory') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-building me-1"></i>Room and Inventory
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Student</th>
                    <th>Boarding House</th>
                    <th>Room / Bed</th>
                    <th>Assignment Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        No room assignments are available to display.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="alert alert-info d-flex align-items-start mb-0" role="status">
    <i class="bi bi-info-circle me-2 mt-1"></i>
    <div>Check room availability and inventory before confirming a placement. Assignment records will appear here when available.</div>
</div>