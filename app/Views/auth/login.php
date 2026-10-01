<!-- Centered Portal Seal Emblem with Interactive Feedback Popover -->
<div class="position-relative">
    <div id="authToastFeedback" class="auth-toast-feedback">
        <i class="bi bi-check2-circle me-1"></i> <span id="authToastMsg">Account autofilled!</span>
    </div>

    <div class="auth-card-logo-container">
        <img src="<?= asset('assets/img/marsu.png') ?>" alt="MarSU Seal" class="auth-card-logo-img">
    </div>
</div>

<!-- Portal Titles -->
<h2 class="auth-portal-title">MARSU ERP PORTAL</h2>
<p class="auth-portal-subtitle">CENTRALIZED AUTHENTICATION SYSTEM</p>

<!-- Interactive Role Selector Tabs -->
<div class="auth-role-tabs" role="tablist">
    <button type="button" class="auth-role-tab active" data-role="student">
        <i class="bi bi-mortarboard-fill"></i> Student
    </button>
    <button type="button" class="auth-role-tab" data-role="faculty">
        <i class="bi bi-person-workspace"></i> Faculty
    </button>
    <button type="button" class="auth-role-tab" data-role="admin">
        <i class="bi bi-shield-shaded"></i> Executive
    </button>
    <button type="button" class="auth-role-tab" data-role="lead">
        <i class="bi bi-people-fill"></i> Lead
    </button>
</div>

<!-- Authentication Form -->
<form method="POST" action="<?= url('login') ?>" id="loginForm" novalidate>
    <?= csrf_field() ?>

    <!-- Username or Identifier Field -->
    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="username" class="auth-field-label mb-0" id="usernameLabel">STUDENT ID OR USERNAME</label>
            <span class="small text-muted" id="roleBadge" style="font-size: 0.7rem; color: #ffd700 !important;">Student Access</span>
        </div>
        <div class="auth-input-container">
            <i class="bi bi-person-vcard auth-field-icon" id="usernameIcon"></i>
            <input type="text" name="username" id="username" 
                   class="form-control auth-field-input" 
                   value="<?= e(old('username')) ?>" 
                   placeholder="Enter Student ID or Username" required autofocus autocomplete="username">
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

<!-- Interactive Quick-Fill Demo Switcher for Instructors & Evaluators -->
<div class="mt-4 pt-2 border-top border-secondary border-opacity-25">
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-link btn-sm text-decoration-none text-white-50 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#demoAccounts" style="font-size: 0.75rem;">
            <i class="bi bi-lightning-charge-fill text-warning me-1"></i> Demo Accounts Quick-Select &dtrif;
        </button>
        <span class="text-white-50 small" style="font-size: 0.7rem;">Click to test roles</span>
    </div>

    <div class="collapse mt-2" id="demoAccounts">
        <div class="auth-demo-box">
            <div class="text-white-50 small mb-2 d-flex justify-content-between align-items-center" style="font-size: 0.72rem;">
                <span>1-Click Credentials Autofill:</span>
                <span class="badge bg-secondary bg-opacity-25 text-gold border border-secondary border-opacity-25">Pass: Password123!</span>
            </div>

            <!-- Core Role Chips -->
            <div class="d-flex flex-wrap gap-1 mb-3">
                <button type="button" class="auth-demo-chip" onclick="applyDemoAccount('admin', 'Password123!', 'admin', 'Super Admin')">
                    <i class="bi bi-shield-shaded text-warning"></i> Admin
                </button>
                <button type="button" class="auth-demo-chip" onclick="applyDemoAccount('dean', 'Password123!', 'admin', 'College Dean')">
                    <i class="bi bi-award-fill text-info"></i> Dean
                </button>
                <button type="button" class="auth-demo-chip" onclick="applyDemoAccount('faculty', 'Password123!', 'faculty', 'Faculty Member')">
                    <i class="bi bi-person-workspace text-primary"></i> Faculty
                </button>
                <button type="button" class="auth-demo-chip" onclick="applyDemoAccount('student', 'Password123!', 'student', 'Student Account')">
                    <i class="bi bi-mortarboard-fill text-success"></i> Student
                </button>
            </div>

            <!-- Student Module Leads Dropdown (11 Modules) -->
            <div class="mt-2">
                <label for="moduleLeadSelect" class="text-white-50 small mb-1 d-block" style="font-size: 0.7rem;">
                    <i class="bi bi-collection-fill text-warning me-1"></i> Test 11 Student Module Leads:
                </label>
                <select id="moduleLeadSelect" class="auth-module-select" onchange="onSelectModuleLead(this)">
                    <option value="" selected disabled>-- Select a Module to Test --</option>
                    <option value="group1_lead">Group 1: 4Ps Beneficiary Student Expenses Monitoring (exp_)</option>
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
        </div>
    </div>
</div>

<!-- Interactive Client-side Scripting (Pure Modern ES6+, Zero jQuery) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleTabs = document.querySelectorAll('.auth-role-tab');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const usernameLabel = document.getElementById('usernameLabel');
    const usernameIcon = document.getElementById('usernameIcon');
    const roleBadge = document.getElementById('roleBadge');
    const clearUserBtn = document.getElementById('clearUsernameBtn');
    const toggleEyeBtn = document.getElementById('togglePasswordBtn');
    const toggleEyeIcon = document.getElementById('togglePasswordIcon');
    const capsAlert = document.getElementById('capsLockAlert');
    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    // Role Metadata Configuration
    const roleConfigs = {
        student: {
            label: 'STUDENT ID OR USERNAME',
            placeholder: 'Enter Student ID (e.g. 21-00123 or student)',
            icon: 'bi-mortarboard-fill',
            badge: 'Student Access',
            defaultUser: 'student'
        },
        faculty: {
            label: 'FACULTY ID OR INSTITUTIONAL EMAIL',
            placeholder: 'e.g. faculty or juan.delacruz@marsu.edu.ph',
            icon: 'bi-person-workspace',
            badge: 'Faculty Member',
            defaultUser: 'faculty'
        },
        admin: {
            label: 'EXECUTIVE / ADMIN USERNAME',
            placeholder: 'e.g. admin or dean',
            icon: 'bi-shield-shaded',
            badge: 'Executive / Dean',
            defaultUser: 'admin'
        },
        lead: {
            label: 'STUDENT MODULE LEAD USERNAME',
            placeholder: 'e.g. group1_lead ... group11_lead',
            icon: 'bi-people-fill',
            badge: 'Module Group Lead',
            defaultUser: 'group1_lead'
        }
    };

    // Role Tab Switching
    roleTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            roleTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const role = this.getAttribute('data-role');
            const cfg = roleConfigs[role];
            if (cfg) {
                usernameLabel.textContent = cfg.label;
                usernameInput.setAttribute('placeholder', cfg.placeholder);
                usernameIcon.className = `bi ${cfg.icon} auth-field-icon`;
                roleBadge.textContent = cfg.badge;
                usernameInput.focus();
            }
        });
    });

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

    // Form Submission Interactive Loading State
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            if (!usernameInput.value.trim() || !passwordInput.value) {
                return;
            }
            submitBtn.disabled = true;
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');
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
function applyDemoAccount(username, password, roleKey, roleTitle) {
    const userInput = document.getElementById('username');
    const passInput = document.getElementById('password');
    if (userInput && passInput) {
        userInput.value = username;
        passInput.value = password;

        // Activate corresponding role tab
        const targetTab = document.querySelector(`.auth-role-tab[data-role="${roleKey}"]`);
        if (targetTab) {
            targetTab.click();
        }

        // Trigger input event to update clear button
        userInput.dispatchEvent(new Event('input'));
        showAuthToast(`Autofilled ${roleTitle} (${username})`);
    }
}

// Module Lead Select Handler
function onSelectModuleLead(selectEl) {
    const val = selectEl.value;
    if (val) {
        const text = selectEl.options[selectEl.selectedIndex].text;
        const groupNum = val.replace('_lead', '').replace('group', 'Group ');
        applyDemoAccount(val, 'Password123!', 'lead', `${groupNum} Lead`);
    }
}
</script>
