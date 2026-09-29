<div class="mb-4">
    <h2 class="h3 font-weight-bold text-marsu-burgundy mb-1">Reset Password</h2>
    <p class="text-muted small">Enter your registered institutional email to receive a password reset link.</p>
</div>

<form method="POST" action="<?= url('forgot-password') ?>">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="email" class="form-label small font-weight-bold text-muted">Institutional Email Address</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" id="email" 
                   class="form-control border-start-0 ps-0" 
                   value="<?= e(old('email')) ?>" 
                   placeholder="e.g. admin@marsu.edu.ph" required autofocus>
        </div>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-marsu btn-lg py-2 fs-6">
            <i class="bi bi-send-check me-2"></i>Send Password Reset Link
        </button>
    </div>

    <div class="text-center mt-3">
        <a href="<?= url('login') ?>" class="small text-marsu-burgundy text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>Back to Sign In
        </a>
    </div>
</form>
