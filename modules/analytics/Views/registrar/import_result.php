<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('CSV Import Result', $term['label'], 'bi-file-earmark-arrow-up',
        '<a href="' . e(url('analytics/registrar/enrollments', ['term' => (int) $term['semester_id']])) . '" class="btn btn-sm btn-outline-secondary">View enrollments</a>') ?>
    <div class="row g-3">
        <div class="col-lg-5"><div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold text-success">Imported (<?= count($created) ?>)</div>
            <ul class="list-group list-group-flush small"><?php foreach ($created as $n): ?><li class="list-group-item"><?= e($n) ?></li><?php endforeach; ?>
                <?php if (!$created): ?><li class="list-group-item text-secondary">None.</li><?php endif; ?></ul>
        </div>
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-transparent fw-semibold">Status synced (<?= count($updated) ?>)</div>
            <ul class="list-group list-group-flush small"><?php foreach ($updated as $n): ?><li class="list-group-item"><?= e($n) ?></li><?php endforeach; ?>
                <?php if (!$updated): ?><li class="list-group-item text-secondary">None.</li><?php endif; ?></ul>
        </div></div>
        <div class="col-lg-7"><div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold text-danger">Errors (<?= count($errors) ?>)</div>
            <ul class="list-group list-group-flush small"><?php foreach ($errors as $m): ?><li class="list-group-item"><?= e($m) ?></li><?php endforeach; ?>
                <?php if (!$errors): ?><li class="list-group-item text-secondary">No errors.</li><?php endif; ?></ul>
        </div></div>
    </div>
</div>
