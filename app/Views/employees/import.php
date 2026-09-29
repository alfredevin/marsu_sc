<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Bulk CSV Employee Import</h1>
        <p class="text-muted small mb-0">Upload a spreadsheet to register faculty and staff members in bulk.</p>
    </div>
    <div>
        <a href="<?= url('employees') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Employee Directory
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header card-header-accent">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-cloud-arrow-up-fill me-2"></i>Upload Personnel Dataset</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= url('employees/import') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label small font-weight-bold">Select CSV File (.csv)</label>
                        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                        <div class="form-text small text-muted">
                            Maximum upload size: 10MB. Format: Comma-Separated Values (.csv).
                        </div>
                    </div>

                    <div class="alert alert-info small d-flex align-items-center">
                        <i class="bi bi-info-circle-fill fs-4 text-info me-3"></i>
                        <div>
                            <strong>Duplicate Safeguard:</strong> Rows with existing employee numbers or emails will be safely bypassed and reported in the completion log without halting the batch.
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-marsu btn-lg py-2">
                            <i class="bi bi-upload me-2"></i>Validate and Import Employees
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
                <p class="text-muted mb-2">CSV headers must match the following schema:</p>
                
                <div class="p-2 bg-white rounded border mb-3 font-monospace" style="font-size: 0.75rem;">
                    employee_number, first_name, middle_name, last_name, suffix, gender, email, contact_number, type, position, rank, department_code, status
                </div>

                <div class="mb-3">
                    <a href="<?= url('employees/template') ?>" class="btn btn-accent btn-sm w-100 font-weight-bold">
                        <i class="bi bi-download me-1"></i>Download Sample CSV Template
                    </a>
                </div>

                <h6 class="font-weight-bold text-muted small mt-3">Field Notes:</h6>
                <ul class="text-muted ps-3 mb-0" style="font-size: 0.82rem;">
                    <li><strong>employee_number:</strong> Unique employee ID (e.g. <code>EMP-2026-001</code>)</li>
                    <li><strong>department_code:</strong> Valid college code (e.g. <code>CICS</code>, <code>CAS</code>, <code>COE</code>)</li>
                    <li><strong>type:</strong> <code>faculty</code>, <code>staff</code>, or <code>admin</code></li>
                </ul>
            </div>
        </div>
    </div>
</div>
