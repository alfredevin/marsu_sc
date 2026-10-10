<!-- Interactive Feedback Popover -->
<div class="position-relative">
    <div id="authToastFeedback" class="auth-toast-feedback">
        <i class="bi bi-check2-circle me-1"></i> <span id="authToastMsg">Account autofilled!</span>
    </div>
</div>

<!-- Portal Titles -->
<div class="text-center mb-4">
    <h2 class="auth-portal-title mb-1">MARSU ERP PORTAL</h2>
    <p class="auth-portal-subtitle mb-0">CENTRALIZED AUTHENTICATION SYSTEM</p>
</div>

<!-- Authentication Form -->
<form method="POST" action="<?= url('login') ?>" id="loginForm" novalidate>
    <?= csrf_field() ?>

    <!-- Username or Identifier Field -->
    <div class="mb-3">
        <label for="username" class="auth-field-label">STUDENT ID OR USERNAME</label>
        <div class="auth-input-container">
            <i class="bi bi-person-vcard auth-field-icon" id="usernameIcon"></i>
            <input type="text" name="username" id="username" 
                   class="form-control auth-field-input" 
                   value="<?= e(old('username')) ?>" 
                   placeholder="Enter ID or Username" required autofocus autocomplete="username">
            <button type="button" class="auth-clear-btn" id="clearUsernameBtn" title="Clear field">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- Password Field with Show/Hide Toggle & Caps Lock Alert -->
    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="password" class="auth-field-label mb-0">PASSWORD</label>
            <a href="<?= url('forgot-password') ?>" class="text-auth-gold small text-decoration-none" style="font-size: 0.75rem;">Forgot password?</a>
        </div>
        <div class="auth-input-container">
            <i class="bi bi-lock-fill auth-field-icon"></i>
            <input type="password" name="password" id="password" 
                   class="form-control auth-field-input" 
                   placeholder="Enter Password" required autocomplete="current-password">
            <button type="button" class="auth-eye-btn" id="togglePasswordBtn" title="Toggle password visibility">
                <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
            </button>
        </div>
        <!-- Real-time Caps Lock Warning Indicator -->
        <div id="capsLockAlert" class="auth-caps-alert d-none">
            <i class="bi bi-capslock-fill me-2"></i><strong>Notice:</strong> Caps Lock is currently ON.
        </div>
    </div>

    <!-- Remember Me Checkbox -->
    <div class="auth-remember-row">
        <label class="auth-checkbox-label">
            <input type="checkbox" name="remember" class="auth-checkbox-input" id="rememberMe">
            <span>Keep me logged in</span>
        </label>
        <span class="small text-white-50" style="font-size: 0.72rem;"><i class="bi bi-shield-check text-success me-1"></i>256-Bit SSL</span>
    </div>

    <!-- Submit Button with Interactive Busy State -->
    <button type="submit" class="btn btn-auth-portal" id="submitBtn">
        <span id="btnText">SIGN IN TO PORTAL <i class="bi bi-box-arrow-in-right ms-2"></i></span>
        <span id="btnSpinner" class="d-none">
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Authenticating credentials...
        </span>
    </button>
</form>

<!-- Interactive Quick-Fill Switcher for Student Module Accounts -->
<div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-link btn-sm text-decoration-none text-white-50 p-0 d-inline-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#demoAccounts" style="font-size: 0.75rem;">
            <i class="bi bi-mortarboard-fill text-gold me-1"></i> Student Module Accounts <i class="bi bi-chevron-down ms-1" style="font-size: 0.7rem;"></i>
        </button>
        <span class="text-white-50 small" style="font-size: 0.7rem;"><i class="bi bi-magic me-1 text-gold"></i>Click to autofill</span>
    </div>

    <div class="collapse mt-2" id="demoAccounts">
        <div class="auth-demo-box">
            <div class="text-white-50 small mb-2 d-flex justify-content-between align-items-center" style="font-size: 0.72rem;">
                <span><i class="bi bi-key-fill text-gold me-1"></i>Select Your Assigned Module:</span>
                <span class="badge bg-secondary bg-opacity-25 text-gold border border-secondary border-opacity-25">Pass: Password123!</span>
            </div>

            <!-- Student Module Leads Dropdown (Active Student Modules) -->
            <div>
                <select id="moduleLeadSelect" class="auth-module-select" onchange="onSelectModuleLead(this)">
                    <option value="" selected disabled>-- Select Your Group's Module Account --</option>
                    <option value="group1_lead">Group 1: Procurement Management Information System (prc_)</option>
                    <option value="group2_lead">Group 2: Institutional Repository &amp; KMS (kmp_)</option>
                    <option value="group3_lead">Group 3: Faculty Teaching Workload Management (wkl_)</option>
                    <option value="group4_lead">Group 4: Medical &amp; Dental Consultation Clinic (hth_)</option>
                    <option value="group5_lead">Group 5: Student Organizations Financial Management (orf_)</option>
                    <option value="group6_lead">Group 6: Student Leadership Development (sld_)</option>
                    <option value="group7_lead">Group 7: Boarding House Management &amp; Directory (hsg_)</option>
                    <option value="group8_lead">Group 8: Student Retention Predictor &amp; Analytics (ret_)</option>
                    <option value="group9_lead">Group 9: University Equipment &amp; IT Asset Management (ast_)</option>
                    <option value="group10_lead">Group 10: Student Welfare Services Management (wlf_)</option>
                    <option value="group11_lead">Group 11: Guidance &amp; Counseling Records System (gdc_)</option>
                </select>
            </div>
            <div class="mt-2 text-white-50 small" style="font-size: 0.68rem;">
                <i class="bi bi-info-circle me-1 text-gold"></i>Logging in with your group account displays only your module in the sidebar.
            </div>
        </div>
    </div>
</div>

<!-- Interactive Client-side Scripting (Pure Modern ES6+, Zero jQuery) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const clearUserBtn = document.getElementById('clearUsernameBtn');
    const toggleEyeBtn = document.getElementById('togglePasswordBtn');
    const toggleEyeIcon = document.getElementById('togglePasswordIcon');
    const capsAlert = document.getElementById('capsLockAlert');
    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    // Clear username button visibility
    function updateClearBtn() {
        if (clearUserBtn) {
            clearUserBtn.style.display = usernameInput.value.length > 0 ? 'flex' : 'none';
        }
    }
    usernameInput.addEventListener('input', updateClearBtn);
    if (clearUserBtn) {
        clearUserBtn.addEventListener('click', function () {
            usernameInput.value = '';
            updateClearBtn();
            usernameInput.focus();
        });
    }
    updateClearBtn();

    // Password Eye Toggle
    if (toggleEyeBtn && passwordInput && toggleEyeIcon) {
        toggleEyeBtn.addEventListener('click', function () {
            const isPass = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPass ? 'text' : 'password');
            toggleEyeIcon.className = isPass ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    }

    // Caps Lock Detection
    function checkCapsLock(e) {
        if (e.getModifierState && capsAlert) {
            const isCaps = e.getModifierState('CapsLock');
            capsAlert.classList.toggle('d-none', !isCaps);
        }
    }
    passwordInput.addEventListener('keydown', checkCapsLock);
    passwordInput.addEventListener('keyup', checkCapsLock);

    // Form Submission Interactive Loading State with MarSU Security Overlay
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            if (!usernameInput.value.trim() || !passwordInput.value) {
                return;
            }
            submitBtn.disabled = true;
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');
            if (typeof window.showMarsuSecurityOverlay === 'function') {
                window.showMarsuSecurityOverlay('Authenticating MarSU Identity...', 'Verifying credentials & RBAC permissions with Central Core...');
            }
        });
    }
});

// Toast feedback notification popover
function showAuthToast(msg) {
    const toast = document.getElementById('authToastFeedback');
    const msgEl = document.getElementById('authToastMsg');
    if (toast && msgEl) {
        msgEl.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }
}

// 1-Click Demo Account Populator
function applyDemoAccount(username, password, roleTitle) {
    const userInput = document.getElementById('username');
    const passInput = document.getElementById('password');
    if (userInput && passInput) {
        userInput.value = username;
        passInput.value = password;

        // Trigger input event to update clear button
        userInput.dispatchEvent(new Event('input'));
        showAuthToast(`Autofilled ${roleTitle} (${username})`);
    }
}

// Module Lead Select Handler
function onSelectModuleLead(selectEl) {
    const val = selectEl.value;
    if (val) {
        const groupNum = val.replace('_lead', '').replace('group', 'Group ');
        applyDemoAccount(val, 'Password123!', `${groupNum} Lead`);
    }
}
</script>
