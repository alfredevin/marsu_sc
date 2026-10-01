<!-- Centered Portal Seal Emblem -->
<div class="auth-card-logo-container">
    <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Seal" class="auth-card-logo-img">
</div>

<!-- Portal Titles -->
<h2 class="auth-portal-title">eCLEARANCE PORTAL</h2>
<p class="auth-portal-subtitle">STUDENT &amp; STAFF AUTHENTICATION</p>

<!-- Authentication Form -->
<form method="POST" action="<?= url('login') ?>" id="loginForm">
    <?= csrf_field() ?>

    <!-- Username or Student ID Field -->
    <div class="mb-3">
        <label for="username" class="auth-field-label">STUDENT ID OR USERNAME</label>
        <div class="auth-input-container">
            <i class="bi bi-person-vcard auth-field-icon"></i>
            <input type="text" name="username" id="username" 
                   class="form-control auth-field-input" 
                   value="<?= e(old('username')) ?>" 
                   placeholder="Enter ID or Username" required autofocus autocomplete="username">
        </div>
    </div>

    <!-- Password Field with Show/Hide Eye Toggle -->
    <div class="mb-4">
        <label for="password" class="auth-field-label">PASSWORD</label>
        <div class="auth-input-container">
            <i class="bi bi-lock-fill auth-field-icon"></i>
            <input type="password" name="password" id="password" 
                   class="form-control auth-field-input" 
                   placeholder="Enter Password" required autocomplete="current-password">
            <button type="button" class="auth-eye-btn" id="togglePasswordBtn" title="Toggle password visibility">
                <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
            </button>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-auth-portal">
        SIGN IN TO PORTAL <i class="bi bi-box-arrow-in-right ms-2"></i>
    </button>

    <!-- Reset Access Link -->
    <div class="text-center mt-4 text-white-50 small">
        Lost credentials? <a href="<?= url('forgot-password') ?>" class="text-auth-gold">Reset Access</a>
    </div>
</form>

<!-- Quick Demo Credentials Helper for Instructors and Developers -->
<div class="text-center mt-3">
    <button class="btn btn-link btn-sm text-decoration-none text-white-50 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#demoAccounts" style="font-size: 0.75rem;">
        <i class="bi bi-key-fill text-warning me-1"></i> Quick Demo Accounts &dtrif;
    </button>
    <div class="collapse mt-2" id="demoAccounts">
        <div class="auth-demo-box text-start">
            <div class="text-white-50 small mb-2" style="font-size: 0.72rem;">Click an account to autofill:</div>
            <div class="d-flex flex-wrap gap-1">
                <button type="button" class="auth-demo-chip" onclick="fillDemo('admin', 'Password123!')">
                    <strong>Admin:</strong> admin
                </button>
                <button type="button" class="auth-demo-chip" onclick="fillDemo('dean', 'Password123!')">
                    <strong>Dean:</strong> dean
                </button>
                <button type="button" class="auth-demo-chip" onclick="fillDemo('faculty', 'Password123!')">
                    <strong>Faculty:</strong> faculty
                </button>
                <button type="button" class="auth-demo-chip" onclick="fillDemo('student', 'Password123!')">
                    <strong>Student:</strong> student
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        if (toggleBtn && passInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                const isPass = passInput.getAttribute('type') === 'password';
                passInput.setAttribute('type', isPass ? 'text' : 'password');
                toggleIcon.className = isPass ? 'bi bi-eye' : 'bi bi-eye-slash';
            });
        }
    });

    function fillDemo(username, password) {
        const userInput = document.getElementById('username');
        const passInput = document.getElementById('password');
        if (userInput && passInput) {
            userInput.value = username;
            passInput.value = password;
        }
    }
</script>
