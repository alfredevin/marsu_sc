<?php
$currentAvatar = !empty($user['avatar']) ? asset($user['avatar']) : asset('assets/img/undraw_profile.svg');
$hasCustomAvatar = !empty($user['avatar']) && str_starts_with($user['avatar'], 'uploads/avatars/');
$roleDisplayName = ucfirst($user['role_name'] ?? ($user['role'] ?? 'User'));
$campusName = 'Santa Cruz Campus (MQE)';
$collegeName = 'College of Information & Computing Sciences';
?>

<div class="profile-page-wrapper">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
                <i class="bi bi-person-badge-fill me-2 text-gold"></i>My Account Profile
            </h1>
            <p class="text-muted small mb-0">Manage your executive identity, personalized avatar, contact records, and security authentication credentials.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm">
                <i class="bi bi-geo-alt-fill text-danger me-1"></i><?= e($campusName) ?>
            </span>
            <span class="badge badge-burgundy px-3 py-2 rounded-pill shadow-sm">
                <i class="bi bi-shield-check text-gold me-1"></i><?= e($roleDisplayName) ?>
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Column: Interactive Identity & Avatar Card -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow-sm border-0 profile-identity-card text-center overflow-hidden mb-4">
                <!-- Top Brand Banner with Gold Accent Wave -->
                <div class="profile-banner-header position-relative">
                    <div class="profile-banner-bg"></div>
                    <div class="profile-status-badge">
                        <span class="badge bg-success border border-2 border-white rounded-pill px-3 py-1 shadow-sm">
                            <span class="status-pulse-dot"></span> Active Session
                        </span>
                    </div>
                </div>

                <div class="card-body px-4 pb-4 pt-0 position-relative">
                    <!-- Interactive Avatar Studio -->
                    <div class="avatar-studio-container mb-3">
                        <div class="avatar-preview-wrapper position-relative mx-auto">
                            <img id="avatarPreviewImg" 
                                 src="<?= $currentAvatar ?>" 
                                 alt="Profile Avatar" 
                                 class="rounded-circle avatar-main-img shadow-lg"
                                 style="width: 130px; height: 130px; object-fit: cover; border: 4px solid #ffffff; background: #fdfbf7;">
                            
                            <!-- Camera Overlay Button -->
                            <button type="button" 
                                    id="avatarTriggerBtn" 
                                    class="btn btn-sm btn-marsu rounded-circle avatar-camera-btn shadow" 
                                    title="Upload New Profile Photo">
                                <i class="bi bi-camera-fill"></i>
                            </button>
                        </div>

                        <!-- Live File Info Pill (Hidden by default) -->
                        <div id="newAvatarNotice" class="d-none mt-2">
                            <span class="badge bg-warning text-dark border px-3 py-1-5 shadow-sm small">
                                <i class="bi bi-image me-1"></i><span id="newAvatarFilename">Ready to save</span>
                            </span>
                            <button type="button" id="cancelNewAvatarBtn" class="btn btn-link btn-sm text-danger p-0 ms-1 text-decoration-none" title="Cancel Selection">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                    </div>

                    <!-- User Name & Title -->
                    <h4 class="h5 font-weight-bold text-marsu-burgundy mb-1">
                        <?= e(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>
                    </h4>
                    <div class="text-muted small fw-semibold mb-2">@<?= e($user['username'] ?? '') ?></div>
                    <div class="d-flex justify-content-center gap-1 mb-3 flex-wrap">
                        <span class="badge badge-gold text-dark px-3 py-1-5 fw-bold rounded-pill shadow-xs">
                            <i class="bi bi-mortarboard-fill me-1"></i><?= e($roleDisplayName) ?>
                        </span>
                    </div>

                    <!-- Quick Telemetry Specs -->
                    <div class="profile-telemetry-box bg-light rounded-3 p-3 text-start small border">
                        <div class="d-flex align-items-center mb-2 text-truncate">
                            <i class="bi bi-envelope-fill me-2 text-marsu-burgundy"></i>
                            <span class="text-truncate" title="<?= e($user['email'] ?? '') ?>"><?= e($user['email'] ?? '') ?></span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-building-fill me-2 text-marsu-burgundy"></i>
                            <span class="text-truncate"><?= e($collegeName) ?></span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-clock-history me-2 text-marsu-burgundy"></i>
                            <span>Last Login: <?= e($user['last_login_at'] ? date('M d, Y h:i A', strtotime($user['last_login_at'])) : 'Active Now') ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield-lock-fill me-2 text-marsu-burgundy"></i>
                            <span>Authentication: Encrypted (Argon2 / BCRYPT)</span>
                        </div>
                    </div>

                    <!-- Avatar Management Options -->
                    <div class="mt-3 pt-3 border-top d-flex flex-column gap-2">
                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-marsu btn-sm rounded-pill px-3" id="quickUploadBtn">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i>Upload Photo
                            </button>
                            <?php if ($hasCustomAvatar): ?>
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3" id="removeAvatarBtn">
                                    <i class="bi bi-trash-fill me-1"></i>Remove
                                </button>
                            <?php endif; ?>
                        </div>

                        <!-- University Preset Avatars Selector Dropdown -->
                        <div class="dropdown mt-1">
                            <button class="btn btn-link btn-sm text-muted text-decoration-none dropdown-toggle small" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-palette2 me-1"></i>Choose default preset avatar
                            </button>
                            <ul class="dropdown-menu dropdown-menu-center p-2 shadow border-0" style="min-width: 250px;">
                                <li class="small text-muted fw-bold px-2 py-1 text-uppercase border-bottom mb-2">University Avatars</li>
                                <li class="d-flex justify-content-around gap-2 px-2 py-1">
                                    <img src="<?= asset('assets/img/undraw_profile.svg') ?>" class="rounded-circle border p-1 preset-avatar-option" data-preset="assets/img/undraw_profile.svg" width="42" height="42" style="cursor: pointer;" title="Classic Executive">
                                    <img src="<?= asset('assets/img/undraw_profile_1.svg') ?>" class="rounded-circle border p-1 preset-avatar-option" data-preset="assets/img/undraw_profile_1.svg" width="42" height="42" style="cursor: pointer;" title="Academic Lead 1">
                                    <img src="<?= asset('assets/img/undraw_profile_2.svg') ?>" class="rounded-circle border p-1 preset-avatar-option" data-preset="assets/img/undraw_profile_2.svg" width="42" height="42" style="cursor: pointer;" title="Academic Lead 2">
                                    <img src="<?= asset('assets/img/undraw_profile_3.svg') ?>" class="rounded-circle border p-1 preset-avatar-option" data-preset="assets/img/undraw_profile_3.svg" width="42" height="42" style="cursor: pointer;" title="Research Fellow">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Interactive Tabbed Settings Workspace -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow-sm border-0 mb-4">
                <!-- Navigation Tabs -->
                <div class="card-header bg-white border-bottom p-0">
                    <ul class="nav nav-tabs nav-fill profile-nav-tabs" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold py-3 px-4 d-flex align-items-center justify-content-center gap-2" 
                                    id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal-tab-pane" type="button" role="tab">
                                <i class="bi bi-person-vcard text-marsu-burgundy fs-5"></i>
                                <span>Personal Information</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold py-3 px-4 d-flex align-items-center justify-content-center gap-2" 
                                    id="security-tab" data-bs-toggle="tab" data-bs-target="#security-tab-pane" type="button" role="tab">
                                <i class="bi bi-shield-lock-fill text-gold fs-5"></i>
                                <span>Security &amp; Password</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold py-3 px-4 d-flex align-items-center justify-content-center gap-2" 
                                    id="privileges-tab" data-bs-toggle="tab" data-bs-target="#privileges-tab-pane" type="button" role="tab">
                                <i class="bi bi-award-fill text-primary fs-5"></i>
                                <span>Clearance &amp; Roles</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <div class="tab-content" id="profileTabContent">
                        <!-- TAB 1: Personal Information -->
                        <div class="tab-pane fade show active" id="personal-tab-pane" role="tabpanel" tabindex="0">
                            <form method="POST" action="<?= url('profile') ?>" enctype="multipart/form-data" id="profileMainForm">
                                <?= csrf_field() ?>
                                
                                <!-- Hidden Avatar Inputs -->
                                <input type="file" name="avatar" id="avatarFileInput" accept="image/jpeg,image/png,image/webp,image/gif" class="d-none">
                                <input type="hidden" name="preset_avatar" id="presetAvatarInput" value="">
                                <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0">

                                <div class="alert alert-soft-burgundy d-flex align-items-center gap-3 p-3 mb-4 rounded-3 border">
                                    <i class="bi bi-info-circle-fill text-marsu-burgundy fs-4"></i>
                                    <div class="small">
                                        Update your institutional name, display information, and official contact email address. Changes take effect across your sessions instantly.
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">First Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                            <input type="text" name="first_name" class="form-control border-start-0" 
                                                   value="<?= e($user['first_name'] ?? '') ?>" required placeholder="Enter first name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Last Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                            <input type="text" name="last_name" class="form-control border-start-0" 
                                                   value="<?= e($user['last_name'] ?? '') ?>" required placeholder="Enter last name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label small fw-bold text-dark">Institutional Email Address <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope-at text-muted"></i></span>
                                            <input type="email" name="email" class="form-control border-start-0" 
                                                   value="<?= e($user['email'] ?? '') ?>" required placeholder="name@marsu.edu.ph">
                                        </div>
                                        <div class="form-text small text-muted">Official MarSU academic email address utilized for password recovery and audit logs.</div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">Username / Student ID</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-muted"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" value="<?= e($user['username'] ?? '') ?>" readonly>
                                        </div>
                                        <div class="form-text small text-muted">System identifier managed by University Registrar &amp; Lead Admin.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">Assigned Campus</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-geo-alt-fill text-muted"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" value="MarSU Santa Cruz Campus (MQE)" readonly>
                                        </div>
                                        <div class="form-text small text-muted">Branch location strictly mapped to Santa Cruz Core platform.</div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top flex-wrap gap-2">
                                    <div class="small text-muted">
                                        <i class="bi bi-shield-check text-success me-1"></i>Session verified with CSRF token protection
                                    </div>
                                    <button type="submit" class="btn btn-marsu px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2" id="saveProfileBtn">
                                        <i class="bi bi-check2-circle fs-5"></i>
                                        <span class="fw-bold">Save Profile Changes</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 2: Security & Password -->
                        <div class="tab-pane fade" id="security-tab-pane" role="tabpanel" tabindex="0">
                            <form method="POST" action="<?= url('profile/password') ?>" id="passwordForm">
                                <?= csrf_field() ?>

                                <div class="alert alert-light border d-flex align-items-start gap-3 p-3 mb-4 rounded-3">
                                    <i class="bi bi-key-fill text-gold fs-4"></i>
                                    <div>
                                        <div class="fw-bold text-dark small">Password Security Policy</div>
                                        <p class="text-muted small mb-0">Use at least 8 characters with a mix of letters, numbers, and symbols. Passwords are securely hashed with BCRYPT work factor 12.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-dark">Current Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                        <input type="password" name="current_password" id="currentPasswordInput" class="form-control border-start-0 border-end-0" required placeholder="Enter current security password">
                                        <button class="btn btn-outline-secondary border-start-0 toggle-pass-btn" type="button" data-target="currentPasswordInput">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">New Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                                            <input type="password" name="new_password" id="newPasswordInput" class="form-control border-start-0 border-end-0" minlength="6" required placeholder="New password">
                                            <button class="btn btn-outline-secondary border-start-0 toggle-pass-btn" type="button" data-target="newPasswordInput">
                                                <i class="bi bi-eye-slash"></i>
                                            </button>
                                        </div>
                                        <!-- Interactive Password Strength Bar -->
                                        <div class="progress mt-2" style="height: 5px;">
                                            <div id="passStrengthBar" class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <div id="passStrengthText" class="form-text small text-muted" style="font-size: 0.72rem;">Enter at least 6 characters</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Confirm New Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-check2-circle text-muted"></i></span>
                                            <input type="password" name="new_password_confirmation" id="confirmPasswordInput" class="form-control border-start-0 border-end-0" required placeholder="Re-type new password">
                                            <button class="btn btn-outline-secondary border-start-0 toggle-pass-btn" type="button" data-target="confirmPasswordInput">
                                                <i class="bi bi-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div id="passMatchNotice" class="form-text small text-muted" style="font-size: 0.72rem;">Passwords must match exactly</div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top flex-wrap gap-2">
                                    <div class="small text-muted">
                                        <i class="bi bi-shield-check text-gold me-1"></i>Audit trail records every password modification
                                    </div>
                                    <button type="submit" class="btn btn-accent px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                                        <i class="bi bi-shield-lock-fill"></i>
                                        <span class="fw-bold">Update Account Password</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 3: Clearance & Roles -->
                        <div class="tab-pane fade" id="privileges-tab-pane" role="tabpanel" tabindex="0">
                            <div class="card border bg-light mb-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="p-3 rounded-circle bg-marsu-burgundy text-white">
                                                <i class="bi bi-shield-fill-check fs-3"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold text-marsu-burgundy mb-1"><?= e($roleDisplayName) ?></h5>
                                                <div class="text-muted small">Assigned Role Clearance • University Master RBAC</div>
                                            </div>
                                        </div>
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Authorized Active</span>
                                    </div>

                                    <div class="row g-3 pt-2">
                                        <div class="col-sm-6">
                                            <div class="p-3 bg-white rounded border">
                                                <div class="small text-muted text-uppercase fw-bold">Platform Scope</div>
                                                <div class="fw-bold text-dark">Central Core + 10 Student Modules</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="p-3 bg-white rounded border">
                                                <div class="small text-muted text-uppercase fw-bold">Executive Power BI</div>
                                                <div class="fw-bold text-success">Full Canvas Visual Access</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="p-3 bg-white rounded border">
                                                <div class="small text-muted text-uppercase fw-bold">Security Enforcement</div>
                                                <div class="fw-bold text-dark">RA 10173 Data Privacy Protection</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="p-3 bg-white rounded border">
                                                <div class="small text-muted text-uppercase fw-bold">Account Established</div>
                                                <div class="fw-bold text-dark"><?= e(date('M d, Y', strtotime($user['created_at'] ?? '2026-09-29'))) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <a href="<?= url('dashboard') ?>" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-arrow-left me-1"></i>Return to Executive Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Profile Custom Theme & Interactive Aesthetics */
.profile-page-wrapper {
    animation: fadeInProfile 0.3s ease-out;
}

@keyframes fadeInProfile {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.profile-identity-card {
    border-radius: 1rem;
    box-shadow: 0 10px 30px rgba(128, 0, 32, 0.06);
}

.profile-banner-header {
    height: 90px;
    background: linear-gradient(135deg, #800020 0%, #4a0013 100%);
}

.profile-banner-bg {
    position: absolute;
    inset: 0;
    opacity: 0.15;
    background-image: radial-gradient(#D4AF37 1px, transparent 1px);
    background-size: 12px 12px;
}

.profile-status-badge {
    position: absolute;
    top: 12px;
    right: 14px;
}

.status-pulse-dot {
    display: inline-block;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background-color: #28a745;
    margin-right: 4px;
    animation: pulseDot 2s infinite;
}

@keyframes pulseDot {
    0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
    70% { box-shadow: 0 0 0 6px rgba(40, 167, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
}

.avatar-preview-wrapper {
    width: 130px;
    height: 130px;
    margin-top: -65px;
}

.avatar-main-img {
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
}

.avatar-preview-wrapper:hover .avatar-main-img {
    transform: scale(1.04);
    box-shadow: 0 12px 25px rgba(128, 0, 32, 0.25) !important;
}

.avatar-camera-btn {
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 36px;
    height: 36px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #ffffff;
    transition: transform 0.2s ease, background-color 0.2s ease;
}

.avatar-camera-btn:hover {
    transform: scale(1.15) rotate(5deg);
}

.profile-nav-tabs .nav-link {
    color: #6c757d;
    border: none;
    border-bottom: 3px solid transparent;
    transition: all 0.2s ease;
}

.profile-nav-tabs .nav-link.active {
    color: #800020 !important;
    border-color: #800020 !important;
    background: transparent;
}

.profile-nav-tabs .nav-link:hover:not(.active) {
    color: #800020;
    border-color: rgba(128, 0, 32, 0.2);
}

.preset-avatar-option:hover {
    transform: scale(1.15);
    border-color: #800020 !important;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.alert-soft-burgundy {
    background-color: rgba(128, 0, 32, 0.05);
    border-color: rgba(128, 0, 32, 0.15);
    color: #4a0013;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Interactive Avatar File Upload & Instant Preview
    const avatarTriggerBtn = document.getElementById('avatarTriggerBtn');
    const quickUploadBtn   = document.getElementById('quickUploadBtn');
    const avatarFileInput  = document.getElementById('avatarFileInput');
    const avatarPreviewImg = document.getElementById('avatarPreviewImg');
    const newAvatarNotice  = document.getElementById('newAvatarNotice');
    const newAvatarFilename= document.getElementById('newAvatarFilename');
    const cancelNewAvatarBtn = document.getElementById('cancelNewAvatarBtn');
    const removeAvatarBtn  = document.getElementById('removeAvatarBtn');
    const removeAvatarInput= document.getElementById('removeAvatarInput');
    const presetAvatarInput= document.getElementById('presetAvatarInput');
    const originalAvatarSrc= avatarPreviewImg.src;

    function triggerFilePicker() {
        if (avatarFileInput) avatarFileInput.click();
    }

    if (avatarTriggerBtn) avatarTriggerBtn.addEventListener('click', triggerFilePicker);
    if (quickUploadBtn) quickUploadBtn.addEventListener('click', triggerFilePicker);

    // Instant Preview on file selection
    if (avatarFileInput) {
        avatarFileInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                // Check 5MB limit
                if (file.size > 5 * 1024 * 1024) {
                    alert('Selected photo exceeds 5MB. Please choose an image smaller than 5MB.');
                    this.value = '';
                    return;
                }

                // FileReader for live preview
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreviewImg.src = event.target.result;
                    if (newAvatarNotice && newAvatarFilename) {
                        newAvatarFilename.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                        newAvatarNotice.classList.remove('d-none');
                    }
                    if (removeAvatarInput) removeAvatarInput.value = '0';
                    if (presetAvatarInput) presetAvatarInput.value = '';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Cancel selected new avatar
    if (cancelNewAvatarBtn) {
        cancelNewAvatarBtn.addEventListener('click', function() {
            if (avatarFileInput) avatarFileInput.value = '';
            avatarPreviewImg.src = originalAvatarSrc;
            if (newAvatarNotice) newAvatarNotice.classList.add('d-none');
        });
    }

    // Preset Avatar Selection
    document.querySelectorAll('.preset-avatar-option').forEach(function(img) {
        img.addEventListener('click', function() {
            const presetPath = this.getAttribute('data-preset');
            if (presetPath) {
                avatarPreviewImg.src = this.src;
                if (presetAvatarInput) presetAvatarInput.value = presetPath;
                if (removeAvatarInput) removeAvatarInput.value = '0';
                if (avatarFileInput) avatarFileInput.value = '';
                if (newAvatarNotice && newAvatarFilename) {
                    newAvatarFilename.textContent = 'Selected Preset Avatar';
                    newAvatarNotice.classList.remove('d-none');
                }
            }
        });
    });

    // Remove Avatar button
    if (removeAvatarBtn) {
        removeAvatarBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove your custom profile picture and reset to default?')) {
                if (removeAvatarInput) removeAvatarInput.value = '1';
                if (avatarFileInput) avatarFileInput.value = '';
                if (presetAvatarInput) presetAvatarInput.value = '';
                avatarPreviewImg.src = "<?= asset('assets/img/undraw_profile.svg') ?>";
                document.getElementById('profileMainForm').submit();
            }
        });
    }

    // 2. Show/Hide Password Eye Toggle
    document.querySelectorAll('.toggle-pass-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            }
        });
    });

    // 3. Live Password Match & Strength Feedback
    const newPassInput = document.getElementById('newPasswordInput');
    const confirmPassInput = document.getElementById('confirmPasswordInput');
    const passStrengthBar = document.getElementById('passStrengthBar');
    const passStrengthText = document.getElementById('passStrengthText');
    const passMatchNotice = document.getElementById('passMatchNotice');

    if (newPassInput) {
        newPassInput.addEventListener('input', function() {
            const val = this.value;
            let strength = 0;
            if (val.length >= 6) strength += 30;
            if (val.length >= 8) strength += 20;
            if (/[0-9]/.test(val)) strength += 25;
            if (/[^A-Za-z0-9]/.test(val)) strength += 25;

            if (passStrengthBar && passStrengthText) {
                passStrengthBar.style.width = strength + '%';
                if (strength < 40) {
                    passStrengthBar.className = 'progress-bar bg-danger';
                    passStrengthText.textContent = 'Weak password';
                } else if (strength < 75) {
                    passStrengthBar.className = 'progress-bar bg-warning';
                    passStrengthText.textContent = 'Moderate security';
                } else {
                    passStrengthBar.className = 'progress-bar bg-success';
                    passStrengthText.textContent = 'Strong password!';
                }
            }
            checkPasswordMatch();
        });
    }

    if (confirmPassInput) {
        confirmPassInput.addEventListener('input', checkPasswordMatch);
    }

    function checkPasswordMatch() {
        if (!newPassInput || !confirmPassInput || !passMatchNotice) return;
        const p1 = newPassInput.value;
        const p2 = confirmPassInput.value;
        if (p2.length === 0) {
            passMatchNotice.textContent = 'Passwords must match exactly';
            passMatchNotice.className = 'form-text small text-muted';
        } else if (p1 === p2) {
            passMatchNotice.innerHTML = '<span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i>Passwords match!</span>';
        } else {
            passMatchNotice.innerHTML = '<span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i>Passwords do not match</span>';
        }
    }
});
</script>
