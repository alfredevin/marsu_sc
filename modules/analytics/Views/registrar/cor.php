<?php
use Modules\Analytics\Support\Ui;

$enrolled = array_values(array_filter($e['subjects'], fn($s) => $s['status'] === 'enrolled'));
$totalUnits = array_sum(array_map(fn($s) => (float) $s['units'], $enrolled));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COR — <?= e($e['student_number']) ?></title>
    <link href="<?= asset('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body { background: #fff; color: #000; font-size: 13px; }
        .sheet { max-width: 820px; margin: 24px auto; }
        .brand { color: #800020; }
        @media print { .no-print { display: none; } .sheet { margin: 0 auto; } }
    </style>
</head>
<body>
<div class="sheet px-3">
    <div class="d-flex align-items-center gap-3 border-bottom pb-2 mb-3">
        <img src="<?= asset('assets/img/marsu.png') ?>" alt="" style="height:56px">
        <div>
            <div class="fw-bold brand fs-5">Marinduque State University</div>
            <div class="fw-semibold">Certificate of Registration · <?= e($e['term_label']) ?></div>
        </div>
        <button class="btn btn-sm btn-outline-secondary ms-auto no-print" type="button" onclick="window.print()">Print</button>
    </div>
    <?php if ($e['status'] !== 'enrolled'): ?>
        <div class="alert alert-warning py-1 small">Enrollment status is <strong><?= e(strtoupper($e['status'])) ?></strong>; this form is not valid as proof of enrollment.</div>
    <?php endif; ?>
    <table class="table table-sm table-borderless mb-3">
        <tr><th style="width:130px">Student No.</th><td><?= e($e['student_number']) ?></td><th style="width:120px">Status</th><td><?= e(ucfirst($e['status'])) ?></td></tr>
        <tr><th>Name</th><td><?= e(Ui::fullName($e)) ?></td><th>Program</th><td><?= e($e['program_name'] ?? $e['program_code']) ?></td></tr>
        <tr><th>Year / Section</th><td><?= (int) $e['year_level'] ?> · <?= e($e['section_name'] ?? '—') ?></td><th>Date enrolled</th><td><?= e($e['enrolled_at'] ? date('F j, Y', strtotime($e['enrolled_at'])) : '—') ?></td></tr>
    </table>
    <table class="table table-sm table-bordered">
        <thead><tr><th>Code</th><th>Descriptive title</th><th class="text-center">Lec</th><th class="text-center">Lab</th><th class="text-center">Units</th></tr></thead>
        <tbody>
            <?php foreach ($enrolled as $s): ?><tr><td><?= e($s['code']) ?></td><td><?= e($s['title']) ?></td><td class="text-center"><?= e((string) $s['lecture_hours']) ?></td><td class="text-center"><?= e((string) $s['lab_hours']) ?></td><td class="text-center"><?= e((string) $s['units']) ?></td></tr><?php endforeach; ?>
            <?php if (!$enrolled): ?><tr><td colspan="5" class="text-center text-secondary">No subjects enrolled.</td></tr><?php endif; ?>
        </tbody>
        <tfoot><tr><th colspan="4" class="text-end">Total units</th><th class="text-center"><?= e((string) $totalUnits) ?></th></tr></tfoot>
    </table>
    <div class="row mt-5 small">
        <div class="col-6 text-center"><div class="border-top pt-1">Student's signature</div></div>
        <div class="col-6 text-center"><div class="border-top pt-1">University Registrar</div></div>
    </div>
    <p class="small text-secondary mt-4">Generated <?= e(date('F j, Y g:i A')) ?>. Personal data is processed under RA 10173 (Data Privacy Act of 2012).</p>
</div>
</body>
</html>
