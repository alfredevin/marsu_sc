<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-house-door-fill me-2 text-gold"></i>Student Housing &amp; Accommodation (ISHAMIS)
        </h1>
        <p class="text-muted small mb-0">Off-campus boarding house rooms, bed spaces, and monthly rates registry.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Form para mag-Add ng Room -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-marsu-burgundy text-white py-3">
                <h6 class="m-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Add New Room</h6>
            </div>
            <div class="card-body p-3">
                <form method="POST" action="<?= url('housing/create') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Room Number / Name: <span class="text-danger">*</span></label>
                        <input type="text" name="room_number" class="form-control form-control-sm" placeholder="e.g. Room 101 / Unit A" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Capacity (Ilang Tao): <span class="text-danger">*</span></label>
                        <input type="number" name="capacity" class="form-control form-control-sm" placeholder="e.g. 4" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Monthly Rate (₱): <span class="text-danger">*</span></label>
                        <input type="number" name="monthly_rate" class="form-control form-control-sm" placeholder="e.g. 1500" step="0.01" min="0" required>
                    </div>

                    <button type="submit" class="btn btn-marsu btn-sm w-100 py-2">
                        <i class="bi bi-check-circle me-1"></i> Save Room Record
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Table ng mga Naka-save na Rooms -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-door-open-fill me-2"></i>Registered Rooms Directory
                </h6>
                <span class="badge badge-burgundy"><?= count($rooms ?? []) ?> Room(s)</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu">
                            <tr>
                                <th>#</th>
                                <th>Room Number</th>
                                <th>Capacity</th>
                                <th>Monthly Rate</th>
                                <th>Status</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($rooms)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-gold"></i>
                                        No rooms added yet. Use the form on the left to add one!
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($rooms as $index => $room): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td class="fw-bold text-marsu-burgundy"><?= e($room['room_number']) ?></td>
                                        <td><?= e($room['capacity']) ?> students</td>
                                        <td class="fw-semibold text-dark">₱<?= number_format((float)$room['monthly_rate'], 2) ?></td>
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i><?= e(ucfirst($room['status'])) ?>
                                            </span>
                                        </td>
                                        <td class="small text-muted"><?= date('M d, Y', strtotime($room['created_at'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>