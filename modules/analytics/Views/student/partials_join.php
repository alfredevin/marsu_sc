<form method="POST" action="<?= url('analytics/my/join') ?>" class="d-flex gap-2">
    <?= csrf_field() ?>
    <input type="text" name="class_code" maxlength="8" required class="form-control form-control-sm text-uppercase" placeholder="Class code" aria-label="Class code" style="max-width:160px">
    <button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-box-arrow-in-right me-1"></i>Join class</button>
</form>
