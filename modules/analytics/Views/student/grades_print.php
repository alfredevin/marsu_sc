<?php
use Modules\Analytics\Support\Ui;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grade Slip — <?= e($student['student_number']) ?></title>
    <link href="<?= asset('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body { background: #fff; color: #000; font-size: 13px; }
        .slip { max-width: 800px; margin: 24px auto; }
        .brand { color: #800020; }
        @media print { .no-print { display: none; } .slip { margin: 0 auto; } }
    </style>
</head>
<body>
<div class="slip px-3">
    <div class="d-flex align-items-center gap-3 border-bottom pb-2 mb-3">
        <img src="<?= asset('assets/img/marsu.png') ?>" alt="" style="height:56px">
        <div>
            <div class="fw-bold brand fs-5">Marinduque State University</div>
            <div>Student Grade Slip · <?= e($term['label'] ?? 'No term selected') ?></div>
        </div>
        <button class="btn btn-sm btn-outline-secondary ms-auto no-print" type="button" onclick="window.print()">Print</button>
    </div>
    <table class="table table-sm table-borderless mb-3">
        <tr><th style="width:140px">Student</th><td><?= e(Ui::fullName($student)) ?></td><th style="width:120px">Student No.</th><td><?= e($student['student_number']) ?></td></tr>
        <tr><th>Program</th><td><?= e($student['program_name'] ?? '') ?></td><th>Year / Section</th><td><?= (int) $student['year_level'] ?> · <?= e($student['section_name'] ?? '') ?></td></tr>
    </table>
    <table class="table table-sm table-bordered">
        <thead><tr><th>Code</th><th>Subject</th><th class="text-center">Units</th><th class="text-center">Final grade</th><th>Remarks</th></tr></thead>
        <tbody>
            <?php if (empty($rows)): ?><tr><td colspan="5" class="text-center text-secondary">No posted grades for this term.</td></tr><?php endif; ?>
            <?php foreach ($rows as $r): ?>
                <tr><td><?= e($r['class']['subject_code']) ?></td><td><?= e($r['class']['subject_title']) ?></td><td class="text-center"><?= e((string) $r['units']) ?></td>
                    <td class="text-center fw-bold"><?= e($r['grade']['final_grade']) ?></td><td><?= e($r['grade']['remarks']) ?></td></tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot><tr><th colspan="3" class="text-end">General Weighted Average</th><th class="text-center"><?= $gwa === null ? '—' : number_format($gwa, 2) ?></th><th></th></tr></tfoot>
    </table>
    <p class="small text-secondary">Only grades posted by faculty are listed. Generated <?= e(date('F j, Y g:i A')) ?>. This slip is unofficial; request a certified copy from the Registrar. Personal data is processed under RA 10173 (Data Privacy Act of 2012).</p>
</div>
</body>
</html>
