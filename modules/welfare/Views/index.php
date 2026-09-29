
<!-- DATA PRIVACY ACT COMPLIANCE BANNER -->
<div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="bi bi-shield-lock-fill fs-3 text-warning"></i>
    <div>
        <strong class="d-block text-dark">Confidentiality Protected under Republic Act 10173 (Data Privacy Act of 2012)</strong>
        <span class="small text-muted">All records in this module are strictly confidential. Unauthorized disclosure, sharing, or tampering with sensitive institutional records is punishable by university policy and Philippine Law. Access is continuously logged in the audit trail.</span>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-shield-check me-2 text-gold"></i><?= e($moduleName) ?>
        </h1>
        <p class="text-muted small mb-0">Manages university scholarship grants, emergency loans, food pantry assistance, and student welfare applications with confidential income data protection.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newRecordModal">
            <i class="bi bi-plus-lg me-1"></i>New Entry
        </button>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-kpi border-burgundy p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Recorded</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count($records) ?></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-shield-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi border-gold p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Active Status</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">
                        <?= count(array_filter($records, fn($r) => ($r['status'] ?? '') === 'active')) ?>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-check2-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Module Channel</div>
                    <div class="h4 font-weight-bold mb-0 text-secondary"><?= e($slug) ?></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-cpu"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Records Table -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy">
            <i class="bi bi-table me-2"></i><?= e($moduleName) ?> Records Directory
        </h6>
        <div class="input-group input-group-sm w-auto">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" id="tableFilterInput" placeholder="Quick search records...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="moduleDataTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Title / Subject</th>
                        <th>Description / Remarks</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-1 text-gold"></i>
                                No records found in <code>wlf_records</code>. Click "New Entry" to add one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-bold text-marsu-burgundy"><?= e($r['title']) ?></td>
                                <td class="small text-muted"><?= e($r['description'] ?? 'No description') ?></td>
                                <td>
                                    <?php if (($r['status'] ?? '') === 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= e(ucfirst($r['status'] ?? 'pending')) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted"><?= e(date('M d, Y h:i A', strtotime($r['created_at']))) ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing entry #<?= $r['id'] ?>')">
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

<!-- Modal: New Entry -->
<div class="modal fade" id="newRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-plus-circle me-2"></i>Create New <?= e($moduleName) ?> Entry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('welfare/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title / Designation <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Assessment Report / Transaction / Case Reference">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description / Observations</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Enter specific details, remarks, or notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-check-lg me-1"></i>Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('tableFilterInput');
    const table = document.getElementById('moduleDataTable');
    if (filterInput && table) {
        filterInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }
});
</script>