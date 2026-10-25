<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #800020 !important;
            color: #fff !important;
        }

        .marsu-maroon-text,
        .text-marsu-burgundy {
            color: #800020 !important;
        }

        .btn-marsu {
            background-color: #800020 !important;
            color: #fff !important;
            border-color: #800020 !important;
        }

        .btn-marsu:hover {
            background-color: #58111a !important;
            color: #fff !important;
            border-color: #58111a !important;
        }

        .badge-burgundy {
            background-color: #800020 !important;
            color: #fff !important;
        }

        .badge-gold {
            background-color: #D4AF37 !important;
            color: #212529 !important;
        }

        .text-gold {
            color: #D4AF37 !important;
        }

        .btn-outline-marsu {
            color: #800020 !important;
            border-color: #800020 !important;
        }

        .btn-outline-marsu:hover {
            background-color: #800020 !important;
            color: #fff !important;
        }

        /* Profile Custom Theme & Interactive Aesthetics (Matching Core Picture 3) */
        .profile-page-wrapper {
            animation: fadeInProfile 0.3s ease-out;
        }

        @keyframes fadeInProfile {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-identity-card {
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(128, 0, 32, 0.06);
            background: #ffffff;
        }

        .profile-banner-header {
            height: 95px;
            background: linear-gradient(135deg, #800020 0%, #4a0013 100%);
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .profile-banner-bg {
            position: absolute;
            inset: 0;
            opacity: 0.18;
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
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(40, 167, 69, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
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
            background: transparent;
        }

        .profile-nav-tabs .nav-link.active {
            color: #800020 !important;
            border-color: #800020 !important;
            background: transparent;
            font-weight: 700;
        }

        .profile-nav-tabs .nav-link:hover:not(.active) {
            color: #800020;
            border-color: rgba(128, 0, 32, 0.25);
        }

        .alert-soft-burgundy {
            background-color: rgba(128, 0, 32, 0.05);
            border-color: rgba(128, 0, 32, 0.15);
            color: #4a0013;
        }

        .form-control-view {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13.5px;
            color: #1e293b;
            font-weight: 600;
        }
    </style>

    <?php if (!empty($selectedStudent)): ?>
        <!-- ===================================================================== -->
        <!-- STATE 2: STUDENT 360° PROFILE DOSSIER (2-COLUMN PICTURE 3 FORMAT)     -->
        <!-- ===================================================================== -->

        <div class="profile-page-wrapper">
            <!-- Top Header & Back Navigation Bar -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <a href="profile" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Student Directory
                    </a>
                    <span class="text-muted">|</span>
                    <h1 class="h4 font-weight-bold text-marsu-burgundy mb-0 d-inline-block">
                        <i class="bi bi-person-badge-fill me-2 text-gold"></i>Student Demographic Profile
                    </h1>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm">
                        <i
                            class="bi bi-geo-alt-fill text-danger me-1"></i><?= htmlspecialchars($demographics['address'] ?? 'Marinduque') ?>
                    </span>
                    <span class="badge badge-burgundy px-3 py-2 rounded-pill shadow-sm">
                        <i
                            class="bi bi-mortarboard-fill text-gold me-1"></i><?= htmlspecialchars($selectedStudent['program_code'] ?? 'N/A') ?>
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i> Print Record
                    </button>
                </div>
            </div>

            <!-- Main Two-Column Row (Picture 3 Structure) -->
            <div class="row g-4">

                <!-- ============================================================= -->
                <!-- LEFT COLUMN: INTERACTIVE IDENTITY & AVATAR CARD              -->
                <!-- ============================================================= -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow-sm border-0 profile-identity-card text-center overflow-hidden mb-4">
                        <!-- Top Brand Banner with Gold Accent Wave -->
                        <div class="profile-banner-header position-relative">
                            <div class="profile-banner-bg"></div>
                            <div class="profile-status-badge">
                                <span
                                    class="badge bg-success border border-2 border-white rounded-pill px-3 py-1 shadow-sm">
                                    <span class="status-pulse-dot"></span>
                                    <?= htmlspecialchars(ucfirst($selectedStudent['enrollment_status'] ?? 'Enrolled')) ?>
                                </span>
                            </div>
                        </div>

                        <div class="card-body px-4 pb-4 pt-0 position-relative">
                            <!-- Circular Avatar Preview with Initials -->
                            <div class="avatar-studio-container mb-3">
                                <div class="avatar-preview-wrapper position-relative mx-auto">
                                    <div class="rounded-circle avatar-main-img shadow-lg"
                                        style="width: 130px; height: 130px; border: 4px solid #ffffff; background: #800020; color: #ffffff; font-size: 40px; font-weight: 700; display: flex; align-items: center; justify-content: center; margin-top: -65px;">
                                        <?= strtoupper(substr($selectedStudent['first_name'] ?? 'S', 0, 1) . substr($selectedStudent['last_name'] ?? 'M', 0, 1)) ?>
                                    </div>

                                    <!-- Verification Badge Overlay Button -->
                                    <div class="avatar-camera-btn btn btn-sm btn-marsu rounded-circle shadow"
                                        title="Officially Matriculated Student">
                                        <i class="bi bi-patch-check-fill text-gold"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Name & Title -->
                            <h4 class="h5 font-weight-bold text-marsu-burgundy mb-1">
                                <?= htmlspecialchars($selectedStudent['full_name']) ?>
                            </h4>
                            <div class="text-muted small fw-semibold mb-2">
                                @<?= htmlspecialchars($selectedStudent['student_number']) ?></div>
                            <div class="d-flex justify-content-center gap-1 mb-3 flex-wrap">
                                <span class="badge badge-gold text-dark px-3 py-1-5 fw-bold rounded-pill shadow-xs">
                                    <i
                                        class="bi bi-mortarboard-fill me-1"></i><?= htmlspecialchars($selectedStudent['program_name']) ?>
                                    (<?= htmlspecialchars($selectedStudent['program_code']) ?>)
                                </span>
                            </div>

                            <!-- Quick Telemetry Specs Box (Matching Picture 3) -->
                            <div class="profile-telemetry-box bg-light rounded-3 p-3 text-start small border">
                                <div class="d-flex align-items-center mb-2 text-truncate">
                                    <i class="bi bi-envelope-fill me-2 text-marsu-burgundy flex-shrink-0"></i>
                                    <span class="text-truncate"
                                        title="<?= htmlspecialchars($selectedStudent['email'] ?? 'N/A') ?>">
                                        <?= htmlspecialchars($selectedStudent['email'] ?? 'N/A') ?>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-2 text-truncate">
                                    <i class="bi bi-building-fill me-2 text-marsu-burgundy flex-shrink-0"></i>
                                    <span
                                        class="text-truncate"><?= htmlspecialchars($selectedStudent['department_name'] ?? 'College of Information & Computing Sciences') ?></span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-diagram-3-fill me-2 text-marsu-burgundy flex-shrink-0"></i>
                                    <span>Year <?= htmlspecialchars((string) ($selectedStudent['year_level'] ?? 1)) ?> •
                                        Section <?= htmlspecialchars($selectedStudent['section_name'] ?? '-') ?></span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone-fill me-2 text-marsu-burgundy flex-shrink-0"></i>
                                    <span><?= htmlspecialchars($selectedStudent['contact_number'] ?? 'Not Recorded') ?></span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt-fill me-2 text-marsu-burgundy flex-shrink-0"></i>
                                    <span
                                        class="text-truncate"><?= htmlspecialchars($demographics['address'] ?? 'Marinduque') ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-shield-check me-2 text-marsu-burgundy flex-shrink-0"></i>
                                    <span>Standing:
                                        <strong><?= htmlspecialchars($academicHistory['academicStanding'] ?? 'Good Standing') ?></strong></span>
                                </div>
                            </div>

                            <!-- Avatar Management Options (Matching Picture 3) -->
                            <div class="mt-3 pt-3 border-top d-flex flex-column gap-2">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-outline-marsu btn-sm rounded-pill px-3"
                                        onclick="alert('Student photo management is linked with MarSU Official University Registrar records.')">
                                        <i class="bi bi-cloud-arrow-up-fill me-1"></i>Upload Photo
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                        onclick="alert('Default institutional student identity initials active.')">
                                        <i class="bi bi-trash-fill me-1"></i>Remove
                                    </button>
                                </div>

                                <!-- University Preset Status Selector Dropdown -->
                                <div class="dropdown mt-1 text-center">
                                    <button
                                        class="btn btn-link btn-sm text-muted text-decoration-none dropdown-toggle small"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-palette2 me-1"></i>Student Identity Options
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-center p-2 shadow border-0"
                                        style="min-width: 250px;">
                                        <li class="small text-muted fw-bold px-2 py-1 text-uppercase border-bottom mb-2">
                                            Matriculation Standing</li>
                                        <li class="px-2 py-1 small">
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle w-100 py-1">
                                                <i class="bi bi-check-circle-fill me-1"></i> Official Active Student
                                            </span>
                                        </li>
                                        <li class="px-2 py-1 small text-muted">
                                            <i class="bi bi-shield-check text-primary me-1"></i> Data Privacy RA 10173
                                            Protected
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Retention Quick Intervention Shortcuts -->
                            <div class="mt-3 pt-3 border-top text-start">
                                <div class="small fw-bold text-secondary text-uppercase mb-2">
                                    <i class="bi bi-lightning-charge-fill text-warning me-1"></i>Retention Interventions:
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <a href="guidancereferrals?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                        class="btn btn-outline-warning text-dark btn-sm rounded-pill w-100 fw-semibold text-start px-3">
                                        <i class="bi bi-person-heart me-2 text-danger"></i>Refer to Guidance & Counseling
                                    </a>
                                    <a href="atriskstudents?flag_student=<?= urlencode($selectedStudent['student_number']) ?>"
                                        class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-semibold text-start px-3">
                                        <i class="bi bi-shield-exclamation me-2"></i>Flag as At-Risk Student
                                    </a>
                                    <a href="advisingrecords?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                        class="btn btn-outline-secondary btn-sm rounded-pill w-100 fw-semibold text-start px-3">
                                        <i class="bi bi-journal-check me-2 text-primary"></i>Log Faculty Advising Session
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================= -->
                <!-- RIGHT COLUMN: INTERACTIVE TABBED WORKSPACE CARD (Picture 3)   -->
                <!-- ============================================================= -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow-sm border-0 mb-4 rounded-3">
                        <!-- Navigation Tabs (Picture 3 Underline Style) -->
                        <div class="card-header bg-white border-bottom p-0">
                            <ul class="nav nav-tabs nav-fill profile-nav-tabs" id="studentSubModuleTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link py-3 px-3 d-flex align-items-center justify-content-center gap-2 <?= ($activeTab === 'demographics') ? 'active' : '' ?>"
                                        id="demographics-tab" data-bs-toggle="tab" data-bs-target="#pane-demographics"
                                        type="button" role="tab" aria-controls="pane-demographics"
                                        aria-selected="<?= ($activeTab === 'demographics') ? 'true' : 'false' ?>">
                                        <i class="bi bi-person-vcard text-marsu-burgundy fs-5"></i>
                                        <span class="fw-bold">Demographic Information</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link py-3 px-3 d-flex align-items-center justify-content-center gap-2 <?= ($activeTab === 'academic') ? 'active' : '' ?>"
                                        id="academic-tab" data-bs-toggle="tab" data-bs-target="#pane-academic" type="button"
                                        role="tab" aria-controls="pane-academic"
                                        aria-selected="<?= ($activeTab === 'academic') ? 'true' : 'false' ?>">
                                        <i class="bi bi-mortarboard text-marsu-burgundy fs-5"></i>
                                        <span class="fw-bold">Academic History</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link py-3 px-3 d-flex align-items-center justify-content-center gap-2 <?= ($activeTab === 'enrollment') ? 'active' : '' ?>"
                                        id="enrollment-tab" data-bs-toggle="tab" data-bs-target="#pane-enrollment"
                                        type="button" role="tab" aria-controls="pane-enrollment"
                                        aria-selected="<?= ($activeTab === 'enrollment') ? 'true' : 'false' ?>">
                                        <i class="bi bi-file-earmark-medical text-marsu-burgundy fs-5"></i>
                                        <span class="fw-bold">Program & Enrollment</span>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Body: Tab Content Workspace -->
                        <div class="card-body p-4">
                            <div class="tab-content" id="studentSubModuleContent">

                                <!-- ========================================================= -->
                                <!-- TAB 1: DEMOGRAPHIC INFORMATION PANE                       -->
                                <!-- ========================================================= -->
                                <div class="tab-pane fade <?= ($activeTab === 'demographics') ? 'show active' : '' ?>"
                                    id="pane-demographics" role="tabpanel" aria-labelledby="demographics-tab">

                                    <!-- Info Alert Notice (Matching Picture 3) -->
                                    <div
                                        class="alert alert-soft-burgundy border d-flex align-items-center gap-3 p-3 rounded-3 mb-4">
                                        <i class="bi bi-info-circle-fill fs-4 text-marsu-burgundy flex-shrink-0"></i>
                                        <div class="small">
                                            Institutional student demographic and socio-economic profile under <strong>RA
                                                10173 (Data Privacy Act of 2012)</strong>. Verified for academic early
                                            warning and retention monitoring.
                                        </div>
                                    </div>

                                    <!-- SECTION 1: Personal & Contact Identity (Picture 3 Form Layout) -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-dark">First Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-person text-muted"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($selectedStudent['first_name'] ?? 'N/A') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-dark">Last Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-person text-muted"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($selectedStudent['last_name'] ?? 'N/A') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label small fw-bold text-dark">Institutional Email Address
                                                <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-envelope-at text-muted"></i></span>
                                                <input type="email"
                                                    class="form-control bg-light border-start-0 text-primary fw-semibold"
                                                    value="<?= htmlspecialchars($selectedStudent['email'] ?? 'N/A') ?>"
                                                    readonly>
                                            </div>
                                            <div class="form-text small text-muted">Official MarSU academic email address
                                                utilized for password recovery and audit logs.</div>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Username / Student ID</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-lock-fill text-muted"></i></span>
                                                <input type="text"
                                                    class="form-control bg-light border-start-0 fw-semibold text-secondary"
                                                    value="<?= htmlspecialchars($selectedStudent['student_number']) ?>"
                                                    readonly>
                                            </div>
                                            <div class="form-text small text-muted">System identifier managed by University
                                                Registrar & Lead Admin.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Assigned Campus</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-geo-alt-fill text-muted"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="MarSU Santa Cruz Campus (MQE)" readonly>
                                            </div>
                                            <div class="form-text small text-muted">Branch location strictly mapped to Santa
                                                Cruz Core platform.</div>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold text-muted">Gender</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-gender-ambiguous text-muted"></i></span>
                                                <input type="text"
                                                    class="form-control bg-light border-start-0 text-capitalize"
                                                    value="<?= htmlspecialchars($selectedStudent['gender'] ?? 'Not Specified') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold text-muted">Date of Birth</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-calendar-event text-muted"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($selectedStudent['birthdate'] ?? 'N/A') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold text-muted">Mobile / Contact
                                                Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-phone text-muted"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($selectedStudent['contact_number'] ?? 'Not Recorded') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted">Permanent Residential
                                                Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-geo-alt-fill text-danger"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($demographics['address'] ?? 'Marinduque') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SECTION 2: Guardian & Emergency Contact -->
                                    <h6 class="fw-bold text-marsu-burgundy mb-3 pb-2 border-bottom">
                                        <i class="bi bi-people-fill me-2 text-gold"></i>Guardian & Emergency Contact
                                    </h6>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Parent / Guardian
                                                Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-person-heart text-muted"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($demographics['guardian_name'] ?? 'Not Recorded') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Guardian Contact
                                                Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-telephone text-muted"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($demographics['guardian_contact'] ?? 'Not Recorded') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted">Reachability Status</label>
                                            <div>
                                                <?php if (!empty($demographics['is_reachable'])): ?>
                                                    <span
                                                        class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                                        <i class="bi bi-check-circle-fill me-1"></i> Reachable via Direct Mobile
                                                        Line
                                                    </span>
                                                <?php else: ?>
                                                    <span
                                                        class="badge bg-warning-subtle text-dark border border-warning-subtle px-3 py-2 rounded-pill">
                                                        <i class="bi bi-exclamation-circle-fill me-1"></i> Unverified / No
                                                        Contact Number on File
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SECTION 3: Housing & Commuting Vulnerability Assessment -->
                                    <h6 class="fw-bold text-marsu-burgundy mb-3 pb-2 border-bottom">
                                        <i class="bi bi-houses-fill me-2 text-gold"></i>Housing & Commuting Vulnerability
                                        Assessment
                                    </h6>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Living Arrangement</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi <?= ($demographics['living_arrangement'] === 'Boarding House') ? 'bi-building text-warning' : 'bi-house-heart text-success' ?>"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($demographics['living_arrangement'] ?? 'With Family') ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Commute Risk Level</label>
                                            <?php
                                            $cRisk = $demographics['commute_risk_level'] ?? 'Low (Local Resident)';
                                            $cIcon = (strpos($cRisk, 'High') !== false) ? 'text-danger' : ((strpos($cRisk, 'Moderate') !== false) ? 'text-warning' : 'text-success');
                                            ?>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="bi bi-shield-fill-exclamation <?= $cIcon ?>"></i></span>
                                                <input type="text" class="form-control bg-light border-start-0"
                                                    value="<?= htmlspecialchars($cRisk) ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-3 bg-light rounded-3 border small text-secondary">
                                                <strong>Retention Risk Assessment:</strong>
                                                <?= (strpos($cRisk, 'High') !== false)
                                                    ? 'Student commutes from a distant municipality. Elevated risk of absenteeism due to transit time and commuting expenses.'
                                                    : (($demographics['living_arrangement'] === 'Boarding House')
                                                        ? 'Staying in a boarding house or dormitory. Moderate vulnerability due to living costs and distance from family support.'
                                                        : 'Living with family near campus. Low demographic vulnerability risk.') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bottom Action Bar (Matching Picture 3) -->
                                    <div
                                        class="d-flex justify-content-between align-items-center pt-3 border-top flex-wrap gap-2">
                                        <div class="small text-muted">
                                            <i class="bi bi-shield-check text-success me-1"></i>Institutional student
                                            demographic record verified under RA 10173
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="profile"
                                                class="btn btn-outline-secondary px-3 py-2 shadow-xs d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-arrow-left"></i>
                                                <span>Back to Roster</span>
                                            </a>
                                            <button type="button"
                                                class="btn btn-marsu px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2"
                                                onclick="window.print()">
                                                <i class="bi bi-printer fs-5"></i>
                                                <span class="fw-bold">Print Student Dossier</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <!-- ========================================================= -->
                                <!-- TAB 2: ACADEMIC HISTORY & TRANSCRIPT PANE                 -->
                                <!-- ========================================================= -->
                                <div class="tab-pane fade <?= ($activeTab === 'academic') ? 'show active' : '' ?>"
                                    id="pane-academic" role="tabpanel" aria-labelledby="academic-tab">

                                    <!-- Academic Summary KPI Banner Card -->
                                    <div class="card border rounded-3 shadow-xs mb-4 bg-light">
                                        <div class="card-body p-3">
                                            <div
                                                class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                                                <div>
                                                    <h6 class="fw-bold text-marsu-burgundy mb-1">
                                                        <i class="bi bi-mortarboard-fill me-2 text-gold"></i>Scholastic
                                                        Standing & Cumulative Performance
                                                    </h6>
                                                    <small class="text-muted">Permanent academic trajectory, GWA tracking,
                                                        and prerequisite block audit.</small>
                                                </div>
                                                <div>
                                                    <?php
                                                    $cumGwa = $academicHistory['cumulativeGwa'] ?? 2.00;
                                                    $failUnits = $academicHistory['totalFailedUnits'] ?? 0;
                                                    ?>
                                                    <?php if ($cumGwa <= 1.75 && $failUnits == 0): ?>
                                                        <span
                                                            class="badge bg-success text-white px-3 py-2 rounded-pill shadow-xs">
                                                            <i class="bi bi-award-fill me-1"></i> Dean's Lister Tier (Honor)
                                                        </span>
                                                    <?php elseif ($failUnits > 0 || $cumGwa > 3.00): ?>
                                                        <span
                                                            class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-xs">
                                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Scholastic
                                                            Deficiency / Probation
                                                        </span>
                                                    <?php else: ?>
                                                        <span
                                                            class="badge bg-primary text-white px-3 py-2 rounded-pill shadow-xs">
                                                            <i class="bi bi-check-circle-fill me-1"></i> Good Academic Standing
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- 4 Stats Cards in Row -->
                                            <div class="row g-2 pt-2 border-top">
                                                <div class="col-sm-3 col-6">
                                                    <small class="text-muted d-block">Cumulative GWA</small>
                                                    <h4
                                                        class="fw-bold mb-0 <?= ($cumGwa > 3.00) ? 'text-danger' : 'text-primary' ?>">
                                                        <?= number_format($cumGwa, 2) ?>
                                                    </h4>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <small class="text-muted d-block">Credited Units Passed</small>
                                                    <h4 class="fw-bold mb-0 text-success">
                                                        <?= number_format($academicHistory['totalEarnedUnits'] ?? 0, 1) ?>
                                                    </h4>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <small class="text-muted d-block">Failed / Deficiency Units</small>
                                                    <h4
                                                        class="fw-bold mb-0 <?= ($failUnits > 0) ? 'text-danger' : 'text-muted' ?>">
                                                        <?= number_format($failUnits, 1) ?>
                                                    </h4>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <small class="text-muted d-block">Support Program</small>
                                                    <div class="mt-1">
                                                        <a href="academicsupportprograms?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">
                                                            <i class="bi bi-mortarboard me-1"></i> Peer Tutoring
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Term Breakdown Ledgers -->
                                    <?php if (!empty($academicHistory['groupedRecords'])): ?>
                                        <?php foreach ($academicHistory['groupedRecords'] as $term): ?>
                                            <div class="card border rounded-3 shadow-xs mb-3 bg-white">
                                                <div
                                                    class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                    <div>
                                                        <span class="fw-bold text-dark"><i
                                                                class="bi bi-calendar-check me-1 text-primary"></i>
                                                            <?= htmlspecialchars($term['term_label']) ?></span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 small">
                                                        <span class="badge bg-white text-dark border">Term Units:
                                                            <strong><?= number_format($term['term_units'], 1) ?></strong></span>
                                                        <span class="badge bg-white text-dark border">Passed:
                                                            <strong><?= number_format($term['passed_units'], 1) ?></strong></span>
                                                        <span
                                                            class="badge <?= ($term['term_gpa'] > 3.00) ? 'bg-danger text-white' : 'bg-primary text-white' ?>">
                                                            Term GPA:
                                                            <strong><?= ($term['term_gpa'] > 0) ? number_format($term['term_gpa'], 2) : 'N/A' ?></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                                        <thead class="table-light text-uppercase small text-muted">
                                                            <tr>
                                                                <th class="ps-3 py-2">Course Code</th>
                                                                <th class="py-2">Course Title</th>
                                                                <th class="py-2 text-center">Units</th>
                                                                <th class="py-2 text-center">Final Grade</th>
                                                                <th class="py-2 text-center">Remarks</th>
                                                                <th class="py-2 text-end pe-3">Curricular Flag</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($term['records'] as $rec): ?>
                                                                <?php
                                                                $isFailed = ($rec['remarks'] === 'FAILED');
                                                                $isInc = ($rec['remarks'] === 'INCOMPLETE');
                                                                ?>
                                                                <tr>
                                                                    <td class="ps-3 fw-bold text-secondary">
                                                                        <?= htmlspecialchars($rec['course_code']) ?>
                                                                    </td>
                                                                    <td class="fw-semibold text-dark">
                                                                        <?= htmlspecialchars($rec['course_title']) ?>
                                                                    </td>
                                                                    <td class="text-center"><?= number_format($rec['units'], 1) ?></td>
                                                                    <td
                                                                        class="text-center fw-bold fs-6 <?= $isFailed ? 'text-danger' : ($isInc ? 'text-warning' : 'text-primary') ?>">
                                                                        <?= htmlspecialchars($rec['grade']) ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($isFailed): ?>
                                                                            <span
                                                                                class="badge bg-danger-subtle text-danger border border-danger-subtle">FAILED</span>
                                                                        <?php elseif ($isInc): ?>
                                                                            <span
                                                                                class="badge bg-warning-subtle text-dark border border-warning-subtle">INCOMPLETE</span>
                                                                        <?php else: ?>
                                                                            <span
                                                                                class="badge bg-success-subtle text-success border border-success-subtle">PASSED</span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="text-end pe-3">
                                                                        <?php if ($isFailed): ?>
                                                                            <span class="badge bg-danger text-white">Prerequisite
                                                                                Blocked</span>
                                                                        <?php elseif ($isInc): ?>
                                                                            <span class="badge bg-warning text-dark">Removal Required</span>
                                                                        <?php else: ?>
                                                                            <span
                                                                                class="badge bg-light text-secondary border">Credited</span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="card border rounded-3 p-4 text-center bg-white">
                                            <i class="bi bi-journal-x fs-1 text-muted mb-2"></i>
                                            <h6 class="fw-bold text-secondary">No Transcript Records Found</h6>
                                            <small class="text-muted">No academic history records currently encoded for this
                                                student in the curriculum database.</small>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <!-- ========================================================= -->
                                <!-- TAB 3: PROGRAM & ENROLLMENT RECORDS PANE                 -->
                                <!-- ========================================================= -->
                                <div class="tab-pane fade <?= ($activeTab === 'enrollment') ? 'show active' : '' ?>"
                                    id="pane-enrollment" role="tabpanel" aria-labelledby="enrollment-tab">

                                    <div class="row g-3 mb-4">
                                        <!-- Degree Program Dossier -->
                                        <div class="col-md-6">
                                            <div class="card border rounded-3 shadow-xs bg-white h-100">
                                                <div class="card-header bg-light py-2 border-bottom">
                                                    <h6 class="fw-bold text-marsu-burgundy mb-0 small text-uppercase">
                                                        <i class="bi bi-mortarboard-fill me-1 text-gold"></i>Degree Program
                                                        & Department
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3">
                                                    <ul class="list-group list-group-flush small">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Degree Program:</span>
                                                            <strong
                                                                class="text-dark"><?= htmlspecialchars($enrollmentRecord['program_name'] ?? 'N/A') ?>
                                                                (<?= htmlspecialchars($enrollmentRecord['program_code'] ?? 'N/A') ?>)</strong>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Department / College:</span>
                                                            <strong
                                                                class="text-dark"><?= htmlspecialchars($enrollmentRecord['department_name'] ?? 'N/A') ?></strong>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Department Chairperson:</span>
                                                            <strong
                                                                class="text-dark"><?= htmlspecialchars($enrollmentRecord['department_head'] ?? 'N/A') ?></strong>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Curricular Duration:</span>
                                                            <strong
                                                                class="text-dark"><?= htmlspecialchars($enrollmentRecord['program_years'] ?? '4 Years') ?></strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Enrollment & Registration Standing -->
                                        <div class="col-md-6">
                                            <div class="card border rounded-3 shadow-xs bg-white h-100">
                                                <div class="card-header bg-light py-2 border-bottom">
                                                    <h6 class="fw-bold text-marsu-burgundy mb-0 small text-uppercase">
                                                        <i class="bi bi-card-checklist me-1 text-gold"></i>Matriculation &
                                                        Registration
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3">
                                                    <ul class="list-group list-group-flush small">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Active Academic Year:</span>
                                                            <strong
                                                                class="text-primary"><?= htmlspecialchars($enrollmentRecord['academic_year'] ?? 'A.Y. 2026-2027') ?></strong>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Active Semester:</span>
                                                            <strong
                                                                class="text-dark"><?= htmlspecialchars($enrollmentRecord['semester'] ?? '1st Semester') ?></strong>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Year Level & Section:</span>
                                                            <strong
                                                                class="text-dark"><?= htmlspecialchars($enrollmentRecord['year_level'] ?? '1st Year') ?>
                                                                -
                                                                <?= htmlspecialchars($enrollmentRecord['section_name'] ?? '-') ?></strong>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Registration Status:</span>
                                                            <span
                                                                class="badge bg-success-subtle text-success border border-success-subtle">
                                                                <?= htmlspecialchars($enrollmentRecord['enrollment_status'] ?? 'Enrolled') ?>
                                                            </span>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                                            <span class="text-muted">Admission Date:</span>
                                                            <strong
                                                                class="text-secondary"><?= htmlspecialchars($enrollmentRecord['admission_date'] ?? 'N/A') ?></strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Active Term Enrolled Subjects Table -->
                                    <div class="card border rounded-3 shadow-xs bg-white">
                                        <div
                                            class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                                            <div>
                                                <h6 class="fw-bold text-marsu-burgundy mb-0">
                                                    <i class="bi bi-book-half me-2 text-gold"></i>Active Term Enrolled
                                                    Course Load
                                                </h6>
                                                <small class="text-muted">Officially matriculated subjects for the current
                                                    semester.</small>
                                            </div>
                                            <div>
                                                <span class="badge marsu-maroon-bg px-3 py-2 fs-7 rounded-pill">
                                                    Total Enrolled Load:
                                                    <?= number_format($enrollmentRecord['total_enrolled_units'] ?? 0, 1) ?>
                                                    Units
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                                <thead class="table-light text-uppercase small text-muted">
                                                    <tr>
                                                        <th class="ps-3 py-3">Course Code</th>
                                                        <th class="py-3">Course Title</th>
                                                        <th class="py-3 text-center">Lec Hours</th>
                                                        <th class="py-3 text-center">Lab Hours</th>
                                                        <th class="py-3 text-center">Credit Units</th>
                                                        <th class="py-3">Prerequisites</th>
                                                        <th class="py-3 text-end pe-3">Enrollment Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($enrollmentRecord['enrolled_subjects'])): ?>
                                                        <?php foreach ($enrollmentRecord['enrolled_subjects'] as $sub): ?>
                                                            <tr>
                                                                <td class="ps-3 fw-bold text-secondary">
                                                                    <?= htmlspecialchars($sub['code']) ?>
                                                                </td>
                                                                <td class="fw-semibold text-dark">
                                                                    <?= htmlspecialchars($sub['title']) ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= number_format($sub['lecture_hours'] ?? 3.0, 1) ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= number_format($sub['lab_hours'] ?? 0.0, 1) ?>
                                                                </td>
                                                                <td class="text-center fw-bold text-primary">
                                                                    <?= number_format($sub['units'] ?? 3.0, 1) ?>
                                                                </td>
                                                                <td class="small text-muted">
                                                                    <?= htmlspecialchars($sub['prerequisites'] ?: 'None') ?>
                                                                </td>
                                                                <td class="text-end pe-3">
                                                                    <span
                                                                        class="badge bg-success-subtle text-success border border-success-subtle">
                                                                        Official Enrolled
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center py-4 text-muted">No active
                                                                enrolled subjects recorded for this term.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php else: ?>
        <!-- ===================================================================== -->
        <!-- STATE 1: STUDENT MASTER DIRECTORY ROSTER (DIRECTORY VIEW)            -->
        <!-- ===================================================================== -->

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">Institutional Student Identity Directory</h6>
                <small class="text-muted">Master authenticated directory with Demographics, Academic History, and Enrollment
                    dossiers.</small>
            </div>

            <form method="GET" action="" id="searchForm" class="d-flex gap-2 align-items-center flex-wrap ms-auto">
                <!-- Search Input na may Instant Filter & Clear Support -->
                <div class="input-group input-group-sm" style="width: 220px;">
                    <input type="search" id="searchInput" name="q" class="form-control" placeholder="Search ID / Name..."
                        value="<?= htmlspecialchars($search ?? '') ?>" autocomplete="off">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>

                <!-- Program Filter -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">PROGRAM:</label>
                <select name="department" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach ($departments as $d): ?>
                        <?php $dCode = is_array($d) ? ($d['code'] ?? '') : $d; ?>
                        <option value="<?= htmlspecialchars($dCode) ?>" <?= ($department === $dCode) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dCode) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Year Level Filter -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">YEAR LEVEL:</label>
                <select name="year_level" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Year Levels</option>
                    <option value="1" <?= ($yearLevel === '1') ? 'selected' : '' ?>>1st Year</option>
                    <option value="2" <?= ($yearLevel === '2') ? 'selected' : '' ?>>2nd Year</option>
                    <option value="3" <?= ($yearLevel === '3') ? 'selected' : '' ?>>3rd Year</option>
                    <option value="4" <?= ($yearLevel === '4') ? 'selected' : '' ?>>4th Year</option>
                </select>

                <!-- Dynamic Section Filter from Database -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">SECTION:</label>
                <select name="section" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Sections</option>
                    <?php foreach ($sections as $sItem): ?>
                        <?php
                        $secName = is_array($sItem) ? ($sItem['name'] ?? '') : $sItem;
                        ?>
                        <option value="<?= htmlspecialchars($secName) ?>" <?= ($section === $secName) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($secName) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if (!empty($department) || !empty($yearLevel) || !empty($section) || !empty($search)): ?>
                    <a href="profile" class="btn btn-sm btn-outline-danger" title="Clear Filters & Search">
                        <i class="bi bi-x-circle"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-responsive bg-white rounded-3 border shadow-sm">
            <table class="table table-hover align-middle mb-0" id="rosterTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student ID</th>
                        <th class="py-3">Student Name & Identity</th>
                        <th class="py-3">Degree Program</th>
                        <th class="py-3 text-center">Section</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($studentList)): ?>
                        <?php foreach ($studentList as $row): ?>
                            <?php $sKey = $row['student_number'] ?? $row['id']; ?>
                            <tr class="student-row">
                                <td class="ps-3 fw-semibold text-secondary col-id">
                                    <?= htmlspecialchars($sKey) ?>
                                </td>
                                <td class="col-name">
                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted">
                                        <i
                                            class="bi bi-geo-alt me-1 text-danger"></i><?= htmlspecialchars($row['address'] ?? 'Marinduque') ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= htmlspecialchars($row['program_code'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-bold fs-7">
                                        <?= htmlspecialchars($row['section_name'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle text-capitalize">
                                        <?= htmlspecialchars($row['enrollment_status'] ?? 'Enrolled') ?>
                                    </span>
                                </td>
                                <!-- SINGLE UNIFIED ACTION BUTTON: VIEW DEMOGRAPHICS -->
                                <td class="text-end pe-4">
                                    <a href="profile?student_id=<?= urlencode($sKey) ?>&tab=demographics"
                                        class="btn btn-sm btn-marsu fw-semibold px-3 shadow-xs" title="View Student Demographics">
                                        <i class="bi bi-person-lines-fill me-1"></i> View Demographics
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No student records found</p>
                                <small>No records matched your search query or selected filters.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Server-Side Table Pagination -->
        <?= $pagination['html'] ?? '' ?>

    <?php endif; ?>

</div>