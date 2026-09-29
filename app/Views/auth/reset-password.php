<div class="mb-4">
    <h2 class="h3 font-weight-bold text-marsu-burgundy mb-1">Set New Password</h2>
    <p class="text-muted small">Choose a strong password with at least 6 characters.</p>
</div>

<form method="POST" action="<?= url('reset-password') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="token" value="<?= e($token ?? '') ?>">

    <div class="mb-3">
        <label for="email" class="form-label small font-weight-bold text-muted">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" value="<?= e($email ?? '') ?>" required readonly>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label small font-weight-bold text-muted">New Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 6 characters" required autofocus>
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="form-label small font-weight-bold text-muted">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-type new password" required>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-marsu btn-lg py-2 fs-6">
            <i class="bi bi-shield-check me-2"></i>Update Password & Sign In
        </button>
    </div>
</form>
