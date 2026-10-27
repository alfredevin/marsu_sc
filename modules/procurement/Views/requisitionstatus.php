<!-- Requisition Status — Procurement Management Information System -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-activity me-2 text-gold"></i>Requisition Status
        </h1>
        <p class="text-muted small mb-0">Track the real-time status of all purchase requests and requisition slips.</p>
    </div>
    <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

<!-- Status Summary Cards -->
<div class="row g-3 mb-4">
    <?php
    $statuses = [
        ['label' => 'Draft',         'icon' => 'bi-pencil',           'color' => 'secondary', 'count' => 0],
        ['label' => 'Submitted',     'icon' => 'bi-send',             'color' => 'primary',   'count' => 0],
        ['label' => 'For Canvassing','icon' => 'bi-search',           'color' => 'info',      'count' => 0],
        ['label' => 'Approved',      'icon' => 'bi-check-circle-fill','color' => 'success',   'count' => 0],
        ['label' => 'PO Issued',     'icon' => 'bi-bag-check-fill',   'color' => 'marsu-burgundy', 'count' => 0],
        ['label' => 'Rejected',      'icon' => 'bi-x-circle-fill',   'color' => 'danger',    'count' => 0],
    ];
    foreach ($statuses as $s): ?>
    <div class="col-6 col-md-2">
        <div class="card border-0 shadow-sm p-3 text-center h-100">
            <i class="bi <?= e($s['icon']) ?> fs-3 text-<?= e($s['color']) ?> mb-2"></i>
            <div class="h4 fw-bold mb-0 text-<?= e($s['color']) ?>"><?= $s['count'] ?></div>
            <div class="small text-muted"><?= e($s['label']) ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Search and Filter -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" id="statusSearchInput" class="form-control form-control-sm" placeholder="Search PR/RIS number or description...">
            </div>
            <div class="col-md-3">
                <select id="statusFilter" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option>Draft</option>
                    <option>Submitted</option>
                    <option>For Canvassing</option>
                    <option>Approved</option>
                    <option>PO Issued</option>
                    <option>Rejected</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                    <input type="date" id="statusDateFrom" class="form-control" placeholder="From">
                    <span class="input-group-text">to</span>
                    <input type="date" id="statusDateTo" class="form-control" placeholder="To">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Tracking Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>All Requisitions
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">PR/RIS No.</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Requesting Office</th>
                        <th>Filed Date</th>
                        <th>Last Updated</th>
                        <th>Status</th>
                        <th class="text-end pe-3">View</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-activity fs-2 d-block mb-2 text-marsu-burgundy opacity-50"></i>
                            No requisitions found. File a PR from the <a href="<?= url('procurement/pr-filling') ?>">PR Filling</a> page.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
