<?php include dirname(__DIR__, 2) . '/_shared/datatable.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-table me-2 text-gold"></i>DataTable Demo
        </h1>
        <p class="text-muted small mb-0">
            Halimbawa ng shared <code>modules/_shared/datatable.php</code>: sort, search, pagination, at "Show N entries".
        </p>
    </div>
    <div>
        <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<!-- ============================================================== -->
<!-- HALIMBAWA 1: Auto-init gamit ang data-marsu-table attribute     -->
<!-- ============================================================== -->
<div class="card mb-4">
    <div class="card-header card-header-accent">
        <h6 class="m-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-people me-2"></i>Tenants (auto-init, built-in search)
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tenantsTable" data-marsu-table data-per-page="10">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Tenant Name</th>
                        <th>Boarding House</th>
                        <th>Room</th>
                        <th>Monthly Rent</th>
                        <th>Status</th>
                        <th>Date Registered</th>
                        <th class="text-end" style="width: 100px;" data-no-sort>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tenants)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No tenants found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tenants as $t): ?>
                            <tr>
                                <td><?= (int)$t['id'] ?></td>
                                <td class="fw-bold text-marsu-burgundy"><?= e($t['name']) ?></td>
                                <td><?= e($t['house']) ?></td>
                                <td><?= e($t['room']) ?></td>
                                <td data-order="<?= (float)$t['rent'] ?>">₱<?= number_format($t['rent'], 2) ?></td>
                                <td>
                                    <?php if ($t['status'] === 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php elseif ($t['status'] === 'pending'): ?>
                                        <span class="badge badge-gold">Pending</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Moved Out</span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted" data-order="<?= strtotime($t['created_at']) ?>">
                                    <?= e(date('M d, Y h:i A', strtotime($t['created_at']))) ?>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- HALIMBAWA 2: Manual init + sariling search input sa card header -->
<!-- ============================================================== -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="m-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-door-open me-2"></i>Rooms (manual init, external search)
        </h6>
        <div class="input-group input-group-sm w-auto">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="search" class="form-control" id="roomsSearch" placeholder="Search rooms...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="roomsTable">
                <thead class="table-marsu">
                    <tr>
                        <th>Boarding House</th>
                        <th>Room</th>
                        <th>Capacity</th>
                        <th>Occupied</th>
                        <th>Available</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $r): ?>
                        <tr>
                            <td><?= e($r['house']) ?></td>
                            <td class="fw-bold"><?= e($r['room']) ?></td>
                            <td><?= (int)$r['capacity'] ?></td>
                            <td><?= (int)$r['occupied'] ?></td>
                            <td><?= max(0, (int)$r['capacity'] - (int)$r['occupied']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    MarsuTable.init('roomsTable', { perPage: 5, search: 'roomsSearch' });
});
</script>
