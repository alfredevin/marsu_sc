<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Bulk CSV Subject Import</h1>
        <p class="text-muted small mb-0">Upload a curriculum spreadsheet to batch register university subjects.</p>
    </div>
    <div>
        <a href="<?= url('subjects') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Subjects
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header card-header-accent">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-cloud-arrow-up-fill me-2"></i>Upload Subject Master File</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= url('subjects/import') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label small font-weight-bold">Select CSV File (.csv)</label>
                        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                        <div class="form-text small text-muted">
                            Maximum upload size: 10MB. Format: Comma-Separated Values (.csv).
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-marsu btn-lg py-2">
                            <i class="bi bi-upload me-2"></i>Process Subject Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card bg-light border-0">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-file-earmark-spreadsheet me-2"></i>CSV File Header Specification</h6>
            </div>
            <div class="card-body small">
                <p class="text-muted mb-2">Required column format:</p>
                
                <div class="p-2 bg-white rounded border mb-3 font-monospace" style="font-size: 0.75rem;">
                    code, title, units, lecture_hours, lab_hours, program_code
                </div>

                <div class="mb-3">
                    <a href="<?= url('subjects/template') ?>" class="btn btn-accent btn-sm w-100 font-weight-bold">
                        <i class="bi bi-download me-1"></i>Download Sample CSV Template
                    </a>
                </div>

                <h6 class="font-weight-bold text-muted small mt-3">Field Rules:</h6>
                <ul class="text-muted ps-3 mb-0" style="font-size: 0.82rem;">
                    <li><strong>code:</strong> Unique subject code (e.g. <code>IS 311</code>)</li>
                    <li><strong>units:</strong> Decimal number (e.g. <code>3.0</code>)</li>
                    <li><strong>program_code:</strong> Valid program code (e.g. <code>BSIS</code>) or leave blank for GenEd.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
