<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">My Account Profile</h1>
        <p class="text-muted small mb-0">Manage your personal credentials, contact details, and security settings.</p>
    </div>
</div>

<div class="row g-4">
    <!-- User Overview Card -->
    <div class="col-lg-4">
        <div class="card text-center p-4">
            <div class="card-body">
                <img src="<?= asset('assets/img/undraw_profile.svg') ?>" 
                     alt="Avatar" width="110" height="110" 
                     class="rounded-circle avatar-ring mb-3">
                <h4 class="h5 font-weight-bold mb-1"><?= e(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?></h4>
                <div class="text-muted small mb-2">@<?= e($user['username'] ?? '') ?></div>
                <span class="badge badge-burgundy mb-3 px-3 py-2"><?= e(ucfirst($user['role_name'] ?? ($user['role'] ?? 'User'))) ?></span>
                
                <hr class="my-3">
                <div class="text-start small text-muted">
                    <div class="mb-2"><i class="bi bi-envelope me-2 text-gold"></i><?= e($user['email'] ?? '') ?></div>
                    <div class="mb-2"><i class="bi bi-clock me-2 text-gold"></i>Last Active: <?= e($user['last_login_at'] ?? 'Current session') ?></div>
                    <div><i class="bi bi-shield-check me-2 text-gold"></i>Status: <span class="badge badge-soft-success">Active</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile & Change Password Cards -->
    <div class="col-lg-8">
        <!-- Edit Info -->
        <div class="card mb-4">
            <div class="card-header card-header-accent">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-person-lines-fill me-2"></i>Personal Information</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= url('profile') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?= e($user['first_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?= e($user['last_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small font-weight-bold">Institutional Email</label>
                            <input type="email" name="email" class="form-control" value="<?= e($user['email'] ?? '') ?>" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i>Save Profile Changes
                    </button>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="card">
            <div class="card-header card-header-accent">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-key-fill me-2"></i>Change Security Password</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= url('profile/password') ?>">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Min. 6 chars" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small font-weight-bold">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-accent">
                        <i class="bi bi-shield-lock me-1"></i>Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
