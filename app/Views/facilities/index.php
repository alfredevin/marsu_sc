<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Campus Buildings & Rooms</h1>
        <p class="text-muted small mb-0">Shared facilities registry utilized across scheduling, asset management, and housing modules.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newBldgModal">
            <i class="bi bi-building-add me-1"></i>New Building
        </button>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newRoomModal">
            <i class="bi bi-plus-lg me-1"></i>New Room
        </button>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Buildings Directory -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-building me-2"></i>Campus Buildings</h6>
                <span class="badge badge-burgundy"><?= count($buildings) ?> Facilities</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 small">
                        <thead class="bg-light">
                            <tr>
                                <th>Code</th>
                                <th>Building Name</th>
                                <th>Location</th>
                                <th class="text-center">Rooms</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($buildings as $b): ?>
                                <tr>
                                    <td><span class="badge badge-gold font-monospace"><?= e($b['code']) ?></span></td>
                                    <td><strong class="text-marsu-burgundy"><?= e($b['name']) ?></strong></td>
                                    <td class="text-muted"><?= e($b['location'] ?: 'Main Campus') ?></td>
                                    <td class="text-center"><span class="badge bg-light text-dark border"><?= $b['rooms_count'] ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Rooms Directory -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-door-open-fill me-2"></i>Instructional & Lab Rooms</h6>
                <span class="badge badge-gold"><?= count($rooms) ?> Rooms</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 small">
                        <thead class="table-marsu">
                            <tr>
                                <th>Room Number</th>
                                <th>Room Name</th>
                                <th>Building</th>
                                <th>Type</th>
                                <th class="text-center">Capacity</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($rooms)): ?>
                                <tr><td colspan="7" class="text-center py-4 text-muted">No rooms recorded yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($rooms as $r): ?>
                                    <tr>
                                        <td><code><?= e($r['room_number']) ?></code></td>
                                        <td><strong class="text-marsu-burgundy"><?= e($r['name']) ?></strong></td>
                                        <td><?= e($r['building_name']) ?></td>
                                        <td><span class="badge badge-burgundy"><?= ucfirst(e($r['type'])) ?></span></td>
                                        <td class="text-center fw-bold"><?= $r['capacity'] ?></td>
                                        <td><span class="badge badge-soft-success"><?= ucfirst(e($r['status'])) ?></span></td>
                                        <td class="text-end">
                                            <form method="POST" action="<?= url('facilities/delete-room') ?>" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" data-confirm-delete="Archive room '<?= e($r['room_number']) ?>'?" title="Archive">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
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

<!-- Modal: New Building -->
<div class="modal fade" id="newBldgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Add Campus Building</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('facilities/create-building') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Building Code</label>
                        <input type="text" name="code" class="form-control form-control-sm" placeholder="e.g. CICS-BLDG" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Building Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. CICS Academic Hall" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Campus Location</label>
                        <input type="text" name="location" class="form-control form-control-sm" placeholder="e.g. Main Campus, Boac">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Building</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: New Room -->
<div class="modal fade" id="newRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-marsu-burgundy">Add Room / Space</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('facilities/create-room') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Parent Building</label>
                        <select name="building_id" class="form-select form-select-sm" required>
                            <?php foreach ($buildings as $b): ?>
                                <option value="<?= $b['id'] ?>"><?= e($b['code']) ?> - <?= e($b['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small font-weight-bold">Room Number</label>
                            <input type="text" name="room_number" class="form-control form-control-sm" placeholder="e.g. CL-101" required>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label small font-weight-bold">Room Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Computer Lab 1" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Room Type</label>
                            <select name="type" class="form-select form-select-sm">
                                <option value="lecture">Lecture Classroom</option>
                                <option value="laboratory">Computer / Science Lab</option>
                                <option value="office">Office / Faculty Lounge</option>
                                <option value="auditorium">Auditorium / Hall</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Capacity</label>
                            <input type="number" name="capacity" class="form-control form-control-sm" value="40" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small font-weight-bold">Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
