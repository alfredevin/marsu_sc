<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Bulk CSV Student Import</h1>
        <p class="text-muted small mb-0">Upload a spreadsheet to register hundreds of students in a single batch.</p>
    </div>
    <div>
        <a href="<?= url('students') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Student Directory
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header card-header-accent">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-cloud-arrow-up-fill me-2"></i>Upload Student Dataset</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= url('students/import') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label small font-weight-bold">Select CSV File (.csv)</label>
                        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                        <div class="form-text small text-muted">
                            Maximum upload size: 10MB. Must be in CSV format. UTF-8 encoding recommended.
                        </div>
                    </div>

                    <div class="alert alert-info small d-flex align-items-center">
                        <i class="bi bi-info-circle-fill fs-4 text-info me-3"></i>
                        <div>
                            <strong>Duplicate Prevention:</strong> If a student number or email address matches an existing active record, that specific row will be flagged and reported in the error log while all valid rows proceed.
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-marsu btn-lg py-2">
                            <i class="bi bi-upload me-2"></i>Validate and Process Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card bg-light border-0">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-file-earmark-spreadsheet me-2"></i>CSV File Format Specification</h6>
            </div>
            <div class="card-body small">
                <p class="text-muted mb-2">Ensure your CSV header contains these exact column names:</p>
                
                <div class="p-2 bg-white rounded border mb-3 font-monospace" style="font-size: 0.75rem;">
                    student_number, first_name, middle_name, last_name, suffix, gender, birthdate, email, contact_number, address, program_code, year_level, section_name, enrollment_status
                </div>

                <div class="mb-3">
                    <a href="<?= url('students/template') ?>" class="btn btn-accent btn-sm w-100 font-weight-bold">
                        <i class="bi bi-download me-1"></i>Download Sample CSV Template
                    </a>
                </div>

                <h6 class="font-weight-bold text-muted small mt-3">Field Guidelines:</h6>
                <ul class="text-muted ps-3 mb-0" style="font-size: 0.82rem;">
                    <li><strong>student_number:</strong> Unique university ID (e.g. <code>23-01452</code>)</li>
                    <li><strong>program_code:</strong> Valid program acronym (e.g. <code>BSIS</code>, <code>BSCS</code>, <code>ACT</code>)</li>
                    <li><strong>gender:</strong> <code>male</code> or <code>female</code></li>
                    <li><strong>year_level:</strong> <code>1</code>, <code>2</code>, <code>3</code>, or <code>4</code></li>
                    <li><strong>birthdate:</strong> <code>YYYY-MM-DD</code></li>
                </ul>
            </div>
        </div>
    </div>
</div>
