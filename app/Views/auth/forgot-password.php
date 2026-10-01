<!-- Portal Titles -->
<div class="text-center mb-4">
    <h2 class="auth-portal-title mb-1">PASSWORD RECOVERY</h2>
    <p class="auth-portal-subtitle mb-0">STUDENT &amp; STAFF ASSISTANCE</p>
</div>

<!-- Forgot Password Form -->
<form method="POST" action="<?= url('forgot-password') ?>">
    <?= csrf_field() ?>

    <div class="mb-4">
        <label for="email" class="auth-field-label">INSTITUTIONAL EMAIL ADDRESS</label>
        <div class="auth-input-container">
            <i class="bi bi-envelope-at-fill auth-field-icon"></i>
            <input type="email" name="email" id="email" 
                   class="form-control auth-field-input" 
                   value="<?= e(old('email')) ?>" 
                   placeholder="e.g. juan.delacruz@marsu.edu.ph" required autofocus>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-auth-portal">
        SEND RESET LINK <i class="bi bi-send-check ms-2"></i>
    </button>

    <!-- Back to Login -->
    <div class="text-center mt-4">
        <a href="<?= url('login') ?>" class="text-auth-gold text-decoration-none small">
            <i class="bi bi-arrow-left me-1"></i> Return to Sign In
        </a>
    </div>
</form>
