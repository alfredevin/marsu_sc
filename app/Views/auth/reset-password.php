<!-- Portal Titles -->
<div class="text-center mb-4">
    <h2 class="auth-portal-title mb-1">NEW PASSWORD</h2>
    <p class="auth-portal-subtitle mb-0">SECURE CREDENTIAL UPDATE</p>
</div>

<!-- Reset Password Form -->
<form method="POST" action="<?= url('reset-password') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="token" value="<?= e($token ?? '') ?>">

    <div class="mb-3">
        <label for="email" class="auth-field-label">CONFIRMED EMAIL</label>
        <div class="auth-input-container">
            <i class="bi bi-envelope-fill auth-field-icon"></i>
            <input type="email" name="email" id="email" class="form-control auth-field-input" value="<?= e($email ?? '') ?>" required readonly>
        </div>
    </div>

    <div class="mb-3">
        <label for="password" class="auth-field-label">NEW PASSWORD</label>
        <div class="auth-input-container">
            <i class="bi bi-lock-fill auth-field-icon"></i>
            <input type="password" name="password" id="password" class="form-control auth-field-input" placeholder="Minimum 6 characters" required autofocus>
        </div>
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="auth-field-label">CONFIRM NEW PASSWORD</label>
        <div class="auth-input-container">
            <i class="bi bi-shield-lock-fill auth-field-icon"></i>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control auth-field-input" placeholder="Re-type new password" required>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-auth-portal">
        UPDATE PASSWORD &amp; SIGN IN <i class="bi bi-shield-check ms-2"></i>
    </button>
</form>
