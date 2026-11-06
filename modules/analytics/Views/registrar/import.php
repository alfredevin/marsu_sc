<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Import Enrollment Records', 'Copy the official enrollment list from the school\'s enrollment system. SPAMS does not enroll students.', 'bi-file-earmark-arrow-up') ?>
    <?= Ui::privacyNotice() ?>
    <?php if (!$activeTerm): ?><div class="alert alert-warning small">No term is active. Choose the term in the form.</div><?php endif; ?>

    <form method="POST" action="<?= url('analytics/registrar/import') ?>" enctype="multipart/form-data" class="card border-0 shadow-sm" style="max-width:760px">
        <?= csrf_field() ?>
        <div class="card-body row g-2 small">
            <p class="text-secondary mb-1">
                Export the enrolled list for the term from the official enrollment system, then upload it here.
                Columns: <code>student_number</code>, <code>subject codes</code> separated by <code>;</code>, optional <code>status</code> (enrolled / withdrawn).
                Program, year and section come from each student's master record. Unknown student numbers are listed as errors and never created.
                Importing the updated list again syncs the status of records already imported.
            </p>
            <div class="col-md-5"><label class="form-label mb-1">Term</label><select name="semester_id" class="form-select form-select-sm" required>
                <?php foreach ($terms as $t): ?><option value="<?= (int) $t['semester_id'] ?>" <?= (int) $t['semester_id'] === (int) ($activeTerm['semester_id'] ?? 0) ? 'selected' : '' ?>><?= e($t['label']) ?></option><?php endforeach; ?>
            </select></div>
            <div class="col-md-7"><label class="form-label mb-1">CSV file</label><input type="file" name="csv" accept=".csv" required class="form-control form-control-sm"></div>
        </div>
        <div class="card-footer bg-transparent"><button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-upload me-1"></i>Import</button></div>
    </form>
</div>
