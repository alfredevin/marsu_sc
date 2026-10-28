<?php
$totalDocuments = count($documents);
$thisMonthCount = count(array_filter($documents, function ($d) {
    return date('Y-m', strtotime($d['uploaded_at'])) === date('Y-m');
}));
?>
<div class="container-fluid py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-file-earmark-richtext me-2 text-gold"></i>Event Documentation
            </h1>
            <p class="text-muted small mb-0">Upload, manage, and archive documents related to scheduled organization activities and events.</p>
        </div>
        <div class="d-flex gap-2">
            <?php if ($events): ?>
                <button type="button" class="btn btn-marsu" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">
                    <i class="bi bi-cloud-arrow-up me-1"></i>Upload Document
                </button>
            <?php endif; ?>
            <a href="<?= e(url('orgleadership')) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Dashboard
            </a>
        </div>
    </div>

    <!-- KPI Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Total Documents</div>
                        <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= $totalDocuments ?></div>
                    </div>
                    <div class="kpi-icon-badge">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Uploaded This Month</div>
                        <div class="h3 font-weight-bold mb-0 text-success"><?= $thisMonthCount ?></div>
                    </div>
                    <div class="kpi-icon-badge badge-gold">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (!$events): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>No scheduled events found. Create events in the Activity Calendar before uploading documents.
        </div>
    <?php else: ?>
        <!-- Table Card with Filters -->
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="fw-bold text-marsu-burgundy"><i class="bi bi-archive me-2"></i>Document Registry</span>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <form method="GET" action="<?= e(url('orgleadership/event-documentation')) ?>" class="d-flex align-items-center gap-2">
                        <label class="visually-hidden" for="calendarFilterSelect">Filter by Event</label>
                        <select name="calendar_id" id="calendarFilterSelect" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            <option value="">All Events</option>
                            <?php foreach ($events as $evt): ?>
                                <option value="<?= (int)$evt['id'] ?>" <?= $calendarFilter === (int)$evt['id'] ? 'selected' : '' ?>>
                                    <?= e($evt['activity_title']) ?> — <?= e($evt['organization_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-sm btn-outline-marsu" type="submit">Filter</button>
                    </form>
                    <div class="input-group input-group-sm w-auto">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="docSearchInput" placeholder="Quick search...">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="documentsTable">
                    <thead class="table-marsu">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Document Type</th>
                            <th>File Name</th>
                            <th>Related Activity</th>
                            <th>Organization</th>
                            <th>Uploaded At</th>
                            <th class="text-end" style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($documents)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-file-earmark-x fs-2 d-block mb-2 text-gold"></i>
                                    No documents found. Click "Upload Document" to add a new record.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($documents as $i => $doc): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <?php
                                        $typeBadge = match ($doc['document_type'] ?? '') {
                                            'Minutes'     => 'bg-primary',
                                            'Photos'      => 'bg-info text-dark',
                                            'Report'      => 'bg-success',
                                            'Certificate' => 'badge-gold',
                                            default       => 'bg-secondary',
                                        };
                                        ?>
                                        <span class="badge <?= $typeBadge ?>"><?= e($doc['document_type']) ?></span>
                                    </td>
                                    <td>
                                        <i class="bi bi-file-earmark me-1 text-muted"></i><?= e($doc['file_name']) ?>
                                        <?php if (!empty($doc['file_path'])): ?>
                                            <small class="d-block text-muted text-truncate" style="max-width: 200px;"><?= e($doc['file_path']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= e($doc['activity_title'] ?? '—') ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><?= e($doc['organization_name'] ?? '—') ?></span>
                                    </td>
                                    <td>
                                        <small><?= e(date('M d, Y h:i A', strtotime($doc['uploaded_at']))) ?></small>
                                    </td>
                                    <td class="text-end">
                                        <?php if (str_starts_with((string)$doc['file_path'], 'modules/orgleadership/uploads/events/')): ?>
                                            <a href="<?= e(url('orgleadership/documents/download?id=' . (int)$doc['id'])) ?>" class="btn btn-sm btn-outline-marsu" title="Download file">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteDocModal<?= (int)$doc['id'] ?>" title="Delete document">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modals -->
<?php foreach ($documents as $doc): ?>
<div class="modal fade" id="deleteDocModal<?= (int)$doc['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-exclamation-triangle me-2"></i>Delete Document</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/documents/delete')) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="document_id" value="<?= (int)$doc['id'] ?>">
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Are you sure you want to delete this document?</p>
                    <strong class="text-danger"><?= e($doc['file_name']) ?></strong>
                    <small class="d-block text-muted mt-1"><?= e($doc['document_type']) ?> — <?= e($doc['activity_title'] ?? 'Unknown Activity') ?></small>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Upload Document Modal -->
<?php if ($events): ?>
<div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-cloud-arrow-up me-2"></i>Upload Event Document</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('orgleadership/documents/store')) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold" for="upload-calendar-id">Related Event <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="upload-calendar-id" name="calendar_id" required>
                            <option value="">— Select Event —</option>
                            <?php foreach ($events as $evt): ?>
                                <option value="<?= (int)$evt['id'] ?>"><?= e($evt['activity_title']) ?> — <?= e($evt['organization_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold" for="upload-doc-type">Document Type <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="upload-doc-type" name="document_type" required>
                            <option value="">— Select Type —</option>
                            <option value="Minutes">Minutes</option>
                            <option value="Photos">Photos</option>
                            <option value="Report">Report</option>
                            <option value="Certificate">Certificate</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold" for="upload-document-file">Document file <span class="text-danger">*</span></label>
                        <input type="file" class="form-control form-control-sm" id="upload-document-file" name="document_file" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" required>
                        <div class="form-text">PDF, Word, Excel, JPG, or PNG files up to 10 MB.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu"><i class="bi bi-save me-1"></i>Save Document</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('docSearchInput');
    const table = document.getElementById('documentsTable');
    if (input && table) {
        input.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();
            table.querySelectorAll('tbody tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });
    }
});
</script>
