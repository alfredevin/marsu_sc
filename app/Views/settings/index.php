<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">System Configuration & Branding</h1>
        <p class="text-muted small mb-0">Manage university brand tokens, active academic calendars, and institutional metadata.</p>
    </div>
</div>

<form method="POST" action="<?= url('settings/update') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- University Brand Settings -->
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-header card-header-accent">
                    <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-bank2 me-2"></i>Institutional Identity</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">System Name</label>
                        <input type="text" name="system_name" class="form-control" value="<?= e(setting('system_name', 'MarSU Centralized ERP')) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">University Name</label>
                        <input type="text" name="university_name" class="form-control" value="<?= e(setting('university_name', 'Marinduque State University')) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">College / Department Attribution</label>
                        <input type="text" name="college_name" class="form-control" value="<?= e(setting('college_name', 'College of Information and Computing Sciences')) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Official Tagline / Motto</label>
                        <input type="text" name="tagline" class="form-control" value="<?= e(setting('tagline', 'Empowering Minds, Transforming Lives, and Advancing Opportunities with HEART')) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Official Campus Postal Address</label>
                        <input type="text" name="school_address" class="form-control" value="<?= e(setting('school_address', 'Panfilo M. Manguera Sr. Rd., Brgy. Tanza, Boac, Marinduque 4900')) ?>">
                    </div>

                    <button type="submit" class="btn btn-marsu">
                        <i class="bi bi-save me-1"></i>Save Configuration
                    </button>
                </div>
            </div>
        </div>

        <!-- Academic & Visual Settings -->
        <div class="col-lg-5">
            <!-- Active Session -->
            <div class="card mb-4">
                <div class="card-header card-header-accent">
                    <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-calendar-check me-2"></i>Active Academic Session</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Active Academic Year</label>
                        <select name="active_academic_year" class="form-select">
                            <?php foreach ($academicYears as $ay): ?>
                                <option value="<?= e($ay['code']) ?>" <?= (setting('active_academic_year') === $ay['code']) ? 'selected' : '' ?>>
                                    A.Y. <?= e($ay['code']) ?> (<?= e($ay['label']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Active Semester</label>
                        <select name="active_semester" class="form-select">
                            <option value="1" <?= (setting('active_semester') === '1') ? 'selected' : '' ?>>1st Semester</option>
                            <option value="2" <?= (setting('active_semester') === '2') ? 'selected' : '' ?>>2nd Semester</option>
                            <option value="summer" <?= (setting('active_semester') === 'summer') ? 'selected' : '' ?>>Summer Term</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Logo & Colors -->
            <div class="card">
                <div class="card-header card-header-accent">
                    <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-palette me-2"></i>University Seal & Color Accent</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="<?= asset(setting('system_logo', 'assets/img/marsu.png')) ?>" 
                             alt="Logo" width="70" height="70" 
                             class="rounded-circle border p-1 bg-white" style="border-color: var(--marsu-gold) !important;">
                        <div>
                            <div class="small fw-bold">Active Seal Asset</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Optimized 256x256 Web Asset</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Upload New Seal (.png, .svg)</label>
                        <input type="file" name="system_logo" class="form-control form-control-sm" accept=".png,.svg,.jpg,.jpeg">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small font-weight-bold">Theme Accent Token (Gold)</label>
                        <div class="input-group input-group-sm">
                            <input type="color" class="form-control form-control-color" name="theme_accent" value="<?= e(setting('theme_accent', '#D4AF37')) ?>" title="Choose accent color">
                            <input type="text" class="form-control" value="<?= e(setting('theme_accent', '#D4AF37')) ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
