<!-- ============================================================== -->
<!-- SAMPLE VIEW PARA SA MGA ESTUDYANTE: FORM (INSERT) + TABLE (FETCH) -->
<!-- ============================================================== -->

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-door-open-fill me-2 text-gold"></i>Sample Room CRUD (Insert & Fetch)
        </h1>
        <p class="text-muted small mb-0">
            Halimbawa kung paano mag-save mula sa form at mag-display ng records mula sa <code>hsg_rooms</code> table.
        </p>
    </div>
    <div>
        <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Bumalik sa Housing Directory
        </a>
    </div>
</div>

<!-- 1. ALERT MESSAGES (Lilitaw kapag nag-success o nag-error ang pag-save) -->
<?php if (Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= e(Core\Session::flash('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <?= e(Core\Session::flash('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- 2. FORM PARA MAG-INSERT NG BAGONG ROOM -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-plus-circle-fill me-2 text-gold"></i>Mag-Add ng Bagong Room
        </h6>
    </div>
    <div class="card-body p-4">
        <form method="POST">
            <!-- MAHALAGA: CSRF Token para tanggapin ng MarSU security middleware -->
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Pangalan ng Room <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="room_name" 
                           class="form-control" 
                           placeholder="Hal. Room 101 - Bed A" 
                           required>
                    <div class="form-text">Ilagay ang numero o pangalan ng kuwarto.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Buwanang Bayad (₱) <span class="text-danger">*</span>
                    </label>
                    <input type="number" 
                           step="0.01" 
                           name="price" 
                           class="form-control" 
                           placeholder="Hal. 1500.00" 
                           required>
                    <div class="form-text">Presyo bawat buwan sa piso.</div>
                </div>

                <div class="col-md-2 d-flex align-items-center">
                    <button type="submit" class="btn btn-marsu w-100 py-2 shadow-sm">
                        <i class="bi bi-save me-1"></i>Save Room
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- 3. TABLE PARA I-DISPLAY ANG NAFETCH MULA SA DATABASE ($rooms) -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Listahan ng mga Naka-save na Rooms
        </h6>
        <span class="badge bg-secondary">
            Kabuuan: <?= count($rooms ?? []) ?>
        </span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 80px;">ID</th>
                        <th>Room Name</th>
                        <th>Monthly Price</th>
                        <th>Petsa Na-save</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rooms)): ?>
                        <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td class="ps-3 text-muted fw-bold">#<?= e($room['id']) ?></td>
                                <td class="fw-bold text-dark">
                                    <i class="bi bi-door-closed me-1 text-secondary"></i>
                                    <?= e($room['room_name']) ?>
                                </td>
                                <td class="text-success fw-bold">
                                    ₱<?= number_format((float)$room['price'], 2) ?>
                                </td>
                                <td class="text-muted small">
                                    <?= e(date('M d, Y h:i A', strtotime($room['created_at']))) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <strong>Walang naka-save na rooms.</strong>
                                <p class="small text-muted mb-0">
                                    Subukang mag-input ng Room Name at Presyo sa form sa itaas at pindutin ang "Save Room"!
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>