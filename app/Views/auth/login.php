<div class="mb-4">
    <h2 class="h3 font-weight-bold text-marsu-burgundy mb-1">Account Sign In</h2>
    <p class="text-muted small">Enter your university credentials to access the central ERP.</p>
</div>

<form method="POST" action="<?= url('login') ?>">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="username" class="form-label small font-weight-bold text-muted">Username or Institutional Email</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
            <input type="text" name="username" id="username" 
                   class="form-control border-start-0 ps-0" 
                   value="<?= e(old('username')) ?>" 
                   placeholder="e.g. admin or juan.delacruz@marsu.edu.ph" required autofocus>
        </div>
    </div>

    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="password" class="form-label small font-weight-bold text-muted mb-0">Password</label>
            <a href="<?= url('forgot-password') ?>" class="small text-marsu-burgundy text-decoration-none">Forgot password?</a>
        </div>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" id="password" 
                   class="form-control border-start-0 ps-0" 
                   placeholder="Enter your password" required>
        </div>
    </div>

    <div class="mb-4 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
        <label class="form-check-label small text-muted" for="rememberMe">Remember me on this browser</label>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-marsu btn-lg py-2 fs-6">
            <i class="bi bi-box-arrow-in-right me-2"></i>Sign In to Dashboard
        </button>
    </div>
</form>

<div class="p-3 bg-light rounded border mt-4">
    <div class="small fw-bold text-marsu-burgundy mb-2"><i class="bi bi-info-circle-fill me-1 text-gold"></i> Demo Credentials Quick-Reference</div>
    <div class="small text-muted d-flex justify-content-between border-bottom pb-1 mb-1">
        <span><strong>Super Admin:</strong> <code>admin</code></span>
        <span>Pass: <code>Password123!</code></span>
    </div>
    <div class="small text-muted d-flex justify-content-between border-bottom pb-1 mb-1">
        <span><strong>Dean:</strong> <code>dean</code></span>
        <span>Pass: <code>Password123!</code></span>
    </div>
    <div class="small text-muted d-flex justify-content-between">
        <span><strong>Faculty:</strong> <code>faculty</code></span>
        <span>Pass: <code>Password123!</code></span>
    </div>
</div>
