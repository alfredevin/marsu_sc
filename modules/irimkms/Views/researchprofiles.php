<div class="container-fluid py-3" id="researchProfilesRoot">

    <!-- CSS & Custom Styling -->
    <style>
        #researchProfilesRoot, #researchProfilesRoot * {
            box-sizing: border-box;
        }

        .modal-backdrop:not(.show) {
            display: none !important;
        }

        :root {
            --maroon-main: #800020;
            --maroon-dark: #5c0017;
            --maroon-light: #fff0f3;
            --gold-accent: #d4af37;
            --gold-light: #fffdf0;
        }

        .text-maroon { color: var(--maroon-main) !important; }
        .bg-maroon { background-color: var(--maroon-main) !important; color: #fff !important; }
        .border-left-maroon { border-left: 0.25rem solid var(--maroon-main) !important; }
        .border-left-gold { border-left: 0.25rem solid var(--gold-accent) !important; }

        .btn-maroon {
            background-color: var(--maroon-main);
            border-color: var(--maroon-main);
            color: #fff;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-maroon:hover {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-outline-maroon {
            border-color: var(--maroon-main);
            color: var(--maroon-main);
            font-weight: 600;
        }
        .btn-outline-maroon:hover {
            background-color: var(--maroon-main);
            color: #fff;
        }

        .badge-gold {
            background-color: var(--gold-accent);
            color: #212529;
            font-weight: 700;
        }

        /* Profile Card Styling */
        .profile-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.25s ease;
            background: #ffffff;
            height: 100%;
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(128, 0, 32, 0.12) !important;
            border-color: rgba(128, 0, 32, 0.3);
        }

        .profile-card-header {
            background: linear-gradient(135deg, #800020 0%, #4a0013 100%);
            height: 80px;
            position: relative;
        }

        .profile-avatar-wrapper {
            width: 90px;
            height: 90px;
            margin: -45px auto 10px auto;
            position: relative;
            z-index: 2;
        }
        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            background: #fff;
        }

        .spec-pill {
            display: inline-block;
            background-color: #f1f3f9;
            color: #4e73df;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            margin: 2px;
            border: 1px solid #e0e4f5;
        }

        .metric-badge {
            background: #f8f9fc;
            border: 1px solid #eaecf4;
            border-radius: 8px;
            padding: 8px 4px;
            text-align: center;
        }
        .metric-badge-value {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--maroon-main);
            line-height: 1.2;
        }
        .metric-badge-label {
            font-size: 0.7rem;
            color: #858796;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        /* Filter Domain Tag Pills */
        .filter-tag-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 20px;
            background-color: #f8f9fc;
            color: #5a5c69;
            font-size: 0.82rem;
            font-weight: 600;
            margin: 3px 2px;
            cursor: pointer;
            border: 1px solid #d1d3e2;
            transition: all 0.2s ease;
        }
        .filter-tag-pill:hover {
            background-color: #eaecf4;
            color: var(--maroon-main);
        }
        .filter-tag-pill.active {
            background-color: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 2px 6px rgba(128, 0, 32, 0.3);
        }

        /* Modal Dossier Header */
        .dossier-cover {
            background: linear-gradient(135deg, #800020 0%, #3d000f 100%);
            height: 120px;
            position: relative;
            border-radius: 12px 12px 0 0;
        }
        .dossier-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #fff;
            position: absolute;
            bottom: -35px;
            left: 25px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .btn-gold {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #212529;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-gold:hover, .btn-gold:focus {
            background-color: #c09e2e;
            border-color: #c09e2e;
            color: #111;
        }

        /* Standard Uniform MarSU Design System */
        .page-hero {
            background: linear-gradient(135deg, #800020 0%, #4a0013 50%, #29000a 100%);
            color: #ffffff;
            border-radius: 14px;
            padding: 26px 30px;
            margin-bottom: 24px;
            box-shadow: 0 6px 20px rgba(128, 0, 32, 0.22);
            position: relative;
            overflow: hidden;
        }
        .page-hero::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.18) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-badge-tag, .hero-badge {
            background: rgba(212, 175, 55, 0.25);
            color: #d4af37;
            border: 1px solid rgba(212, 175, 55, 0.45);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .page-hero-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.35rem;
            letter-spacing: -0.01em;
            line-height: 1.25;
        }
        .page-hero-subtitle {
            font-size: 0.94rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
            max-width: 720px;
            line-height: 1.5;
        }

        .main-nav-pill {
            padding: 0.65rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            color: #495057;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .main-nav-pill:hover {
            background: #e9ecef;
            color: #800020;
        }
        .main-nav-pill.active {
            background: #800020;
            color: #ffffff;
            border-color: #800020;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.2);
        }
    </style>

    <!-- Uniform MarSU Hero Banner -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="hero-badge-tag"><i class="fas fa-user-graduate me-1"></i> Researcher Registry</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-id-badge me-2 text-warning"></i>Faculty & Researcher Directory
            </h1>
            <p class="page-hero-subtitle">
                Discover MarSU faculty researchers, specializations, academic publications, citation metrics, ORCID integration, and ongoing research projects.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" onclick="openAddResearcherModal()">
                <i class="fas fa-user-plus me-1"></i> Register Faculty
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill"><i class="bi bi-file-earmark-check text-maroon me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprofiles') ?>" class="main-nav-pill active"><i class="bi bi-person-badge text-white me-1"></i> Faculty Directory</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill"><i class="bi bi-journal-code text-maroon me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill"><i class="bi bi-flag text-maroon me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill"><i class="bi bi-hourglass-split text-maroon me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill"><i class="bi bi-cash-coin text-maroon me-1"></i> Grants & Funding</a>
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill"><i class="bi bi-book-half text-maroon me-1"></i> Publications</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

    <!-- Dynamic Flash Messages -->
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= e($_SESSION['flash_success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= e($_SESSION['flash_error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <!-- Top Metric Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                                Total Registered Faculty
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['total_faculty'] ?? count($researchers ?? [])) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-gold shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Active Principal Investigators
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['active_pis'] ?? 0) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Indexed Publications
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['total_publications'] ?? 0) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Scopus Citation Index
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['total_citations'] ?? 0) ?>+</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-quote-right fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="card shadow mb-4">
        <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-md-5 mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control"
                            placeholder="Search by researcher name, specialization, department, or ORCID..."
                            id="mainSearchInput" oninput="filterResearchers()">
                        <button type="button" class="btn bg-maroon text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-4 mb-2 mb-md-0">
                    <select class="form-select" id="collegeFilter" onchange="filterResearchers()">
                        <option value="all" selected>All Colleges & Departments</option>
                        <option value="CIT">College of Information Technology (CIT)</option>
                        <option value="COA">College of Agriculture (COA)</option>
                        <option value="CSM">College of Science & Mathematics (CSM)</option>
                        <option value="COE">College of Engineering (COE)</option>
                        <option value="CHS">College of Health Sciences (CHS)</option>
                        <option value="CED">College of Education (CED)</option>
                        <option value="CBA">College of Business & Accountancy (CBA)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="rankFilter" onchange="filterResearchers()">
                        <option value="all" selected>All Academic Ranks</option>
                        <option value="Professor">Full Professor</option>
                        <option value="Associate">Associate Professor</option>
                        <option value="Assistant">Assistant Professor</option>
                        <option value="Instructor">Instructor</option>
                    </select>
                </div>
            </div>

            <!-- Domain Filter Pills -->
            <div class="mt-3 pt-2 border-top d-flex align-items-center flex-wrap">
                <span class="small font-weight-bold text-muted me-2">Filter Domain:</span>
                <span class="filter-tag-pill active" onclick="filterDomain('all', this)">All Domains</span>
                <span class="filter-tag-pill" onclick="filterDomain('AI', this)"><i class="fas fa-robot me-1"></i> AI & Data Science</span>
                <span class="filter-tag-pill" onclick="filterDomain('Agriculture', this)"><i class="fas fa-seedling me-1"></i> Sustainable Agriculture</span>
                <span class="filter-tag-pill" onclick="filterDomain('Environment', this)"><i class="fas fa-leaf me-1"></i> Environmental Ecology</span>
                <span class="filter-tag-pill" onclick="filterDomain('Energy', this)"><i class="fas fa-bolt me-1"></i> Renewable Energy</span>
                <span class="filter-tag-pill" onclick="filterDomain('Health', this)"><i class="fas fa-heartbeat me-1"></i> Public Health</span>
            </div>
        </div>
    </div>

    <!-- Faculty Profiles Grid Container -->
    <div class="row" id="researchersGrid">

        <?php if (!empty($researchers)): ?>
            <?php foreach ($researchers as $idx => $r): ?>
                <?php
                    $specs = array_filter(array_map('trim', explode(',', $r['specializations'] ?? '')));
                    $badgeColor = match($r['badge_color'] ?? 'warning') {
                        'gold' => 'background:#FFD700; color:#800020;',
                        'success' => 'background:#1cc88a; color:#fff;',
                        'info' => 'background:#36b9cc; color:#fff;',
                        'primary' => 'background:#4e73df; color:#fff;',
                        'danger' => 'background:#e74a3b; color:#fff;',
                        'secondary' => 'background:#858796; color:#fff;',
                        default => 'background:#f6c23e; color:#000;'
                    };
                    $jsonAttr = htmlspecialchars(json_encode($r), ENT_QUOTES, 'UTF-8');
                    $searchData = strtolower(e($r['full_name'] . ' ' . $r['department'] . ' ' . $r['college'] . ' ' . $r['specializations'] . ' ' . $r['orcid'] . ' ' . $r['title_rank'] . ' ' . $r['research_domain']));
                ?>
                <div class="col-xl-4 col-md-6 mb-4 researcher-card-col" 
                     data-college="<?= e($r['college'] ?? '') ?>" 
                     data-rank="<?= e($r['academic_rank'] ?? '') ?>" 
                     data-domain="<?= e($r['research_domain'] ?? '') ?>" 
                     data-search="<?= $searchData ?>">
                    <div class="card profile-card shadow">
                        <div class="profile-card-header">
                            <?php if (!empty($r['badge_label'])): ?>
                                <span class="badge font-weight-bold position-absolute" style="top:10px; right:10px; <?= $badgeColor ?>">
                                    <?= e($r['badge_label']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="profile-avatar-wrapper">
                            <img src="<?= asset('assets/img/undraw_profile.svg') ?>" 
                                 onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($r['full_name']) ?>&background=800020&color=ffffff&size=128'" 
                                 class="profile-avatar" 
                                 alt="<?= e($r['full_name']) ?>">
                        </div>
                        <div class="card-body text-center pt-2 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="font-weight-bold text-dark mb-0"><?= e($r['full_name']) ?></h5>
                                <small class="text-maroon font-weight-bold d-block mb-1"><?= e($r['title_rank']) ?></small>
                                <small class="text-muted d-block mb-2">
                                    <i class="fas fa-university me-1"></i><?= e($r['department'] ?: 'Faculty of Research') ?> 
                                    <?php if (!empty($r['college'])): ?>
                                        <span class="badge bg-light text-dark ms-1"><?= e($r['college']) ?></span>
                                    <?php endif; ?>
                                </small>

                                <div class="mb-3" style="min-height: 52px;">
                                    <?php if (!empty($specs)): ?>
                                        <?php foreach (array_slice($specs, 0, 3) as $spec): ?>
                                            <span class="spec-pill"><?= e($spec) ?></span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="spec-pill text-muted">General Research</span>
                                    <?php endif; ?>
                                </div>

                                <div class="row no-gutters mb-3">
                                    <div class="col-4">
                                        <div class="metric-badge">
                                            <div class="metric-badge-value"><?= number_format($r['active_projects'] ?? 0) ?></div>
                                            <div class="metric-badge-label">Projects</div>
                                        </div>
                                    </div>
                                    <div class="col-4 px-1">
                                        <div class="metric-badge">
                                            <div class="metric-badge-value"><?= number_format($r['publications_count'] ?? 0) ?></div>
                                            <div class="metric-badge-label">Papers</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="metric-badge">
                                            <div class="metric-badge-value">h-<?= number_format($r['h_index'] ?? 0) ?></div>
                                            <div class="metric-badge-label">h-Index</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-2">
                                <small class="text-muted">
                                    <i class="far fa-id-badge me-1"></i><?= !empty($r['orcid']) ? e($r['orcid']) : 'N/A' ?>
                                </small>
                                <button class="btn btn-sm btn-maroon" onclick="openProfileModal(<?= $jsonAttr ?>)">
                                    <i class="fas fa-user-circle me-1"></i> View Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 py-5 text-center" id="noResultsState">
                <div class="card shadow-sm border-0 py-5">
                    <div class="card-body">
                        <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                        <h4 class="text-gray-800 font-weight-bold">No Researcher Profiles Found</h4>
                        <p class="text-muted mb-3">There are no faculty researchers matching the specified criteria.</p>
                        <button class="btn btn-maroon btn-sm" onclick="openAddResearcherModal()">
                            <i class="fas fa-plus me-1"></i> Add First Faculty Researcher
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <!-- End of Researchers Grid -->

    <!-- Empty Search State Placeholder (JS hidden by default) -->
    <div class="row d-none" id="emptySearchNotice">
        <div class="col-12 py-4 text-center">
            <div class="card shadow-sm border-0 py-4">
                <div class="card-body">
                    <i class="fas fa-search fa-2x text-muted mb-2"></i>
                    <h5 class="text-dark font-weight-bold mb-1">No Matching Faculty Found</h5>
                    <p class="text-muted small mb-0">Try adjusting your search query, department filter, or research domain selection.</p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: ADD FACULTY RESEARCHER                                                     -->
<!-- ==================================================================================== -->
<div class="modal fade" id="addResearcherModal" tabindex="-1" aria-labelledby="addResearcherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="addResearcherModalLabel">
                    <i class="fas fa-user-plus me-2"></i>Register New Faculty Researcher
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('irimkms/researchers/store') ?>" method="POST" id="addResearcherForm">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="alert alert-light border-left-maroon small mb-3">
                        <i class="fas fa-info-circle me-1 text-maroon"></i> Provide faculty credentials to list them in the university's research directory and track their citations & h-index.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label class="form-label font-weight-bold text-dark">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="full_name" placeholder="e.g. Dr. Maria Clara Santos, PhD" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label font-weight-bold text-dark">Title & Academic Rank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title_rank" placeholder="e.g. Associate Professor II" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Academic Rank Category</label>
                            <select class="form-select" name="academic_rank">
                                <option value="Professor">Full Professor</option>
                                <option value="Associate" selected>Associate Professor</option>
                                <option value="Assistant">Assistant Professor</option>
                                <option value="Instructor">Instructor</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">College / Faculty</label>
                            <select class="form-select" name="college">
                                <option value="CIT" selected>College of Information Technology (CIT)</option>
                                <option value="COA">College of Agriculture (COA)</option>
                                <option value="CSM">College of Science & Mathematics (CSM)</option>
                                <option value="COE">College of Engineering (COE)</option>
                                <option value="CHS">College of Health Sciences (CHS)</option>
                                <option value="CED">College of Education (CED)</option>
                                <option value="CBA">College of Business & Accountancy (CBA)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Primary Research Domain</label>
                            <select class="form-select" name="research_domain">
                                <option value="AI" selected>AI & Data Science</option>
                                <option value="Agriculture">Sustainable Agriculture</option>
                                <option value="Environment">Environmental Ecology</option>
                                <option value="Energy">Renewable Energy</option>
                                <option value="Health">Public Health</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Department</label>
                            <input type="text" class="form-control" name="department" placeholder="e.g. Dept. of Information Technology">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Institutional Email</label>
                            <input type="email" class="form-control" name="email" placeholder="faculty.name@msu.edu.ph">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Badge / Distinction Tag</label>
                            <input type="text" class="form-control" name="badge_label" placeholder="e.g. Lead PI, DOST Grantee, Senior Fellow">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Badge Color Style</label>
                            <select class="form-select" name="badge_color">
                                <option value="warning">Gold / Yellow (Lead PI)</option>
                                <option value="success">Green (Grantee / Funded)</option>
                                <option value="info">Cyan (Senior Fellow)</option>
                                <option value="primary">Blue (Chair / Coordinator)</option>
                                <option value="danger">Red (Director)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">ORCID Identifier</label>
                            <input type="text" class="form-control" name="orcid" placeholder="e.g. 0000-0002-1825-4921">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Specializations (Comma separated)</label>
                            <input type="text" class="form-control" name="specializations" placeholder="e.g. Artificial Intelligence, IoT, Water Resources">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold text-dark">Active Projects</label>
                            <input type="number" class="form-control" name="active_projects" value="1" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold text-dark">Publications</label>
                            <input type="number" class="form-control" name="publications_count" value="0" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold text-dark">h-Index Score</label>
                            <input type="number" class="form-control" name="h_index" value="1" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold text-dark">Citations Count</label>
                            <input type="number" class="form-control" name="citations_count" value="0" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Faculty Biography & Research Focus</label>
                        <textarea class="form-control" name="bio" rows="3" placeholder="Brief statement regarding research agenda, active grants, lab leadership, and academic contributions..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> Register Researcher
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: RESEARCHER PROFILE DOSSIER (VIEW DETAILS)                                   -->
<!-- ==================================================================================== -->
<div class="modal fade" id="researcherDetailModal" tabindex="-1" aria-labelledby="researcherDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body p-0">

                <!-- Header cover -->
                <div class="dossier-cover p-3 text-end">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    <img id="dossierAvatar" src="<?= asset('assets/img/undraw_profile.svg') ?>" class="dossier-avatar" alt="Avatar">
                </div>

                <div class="p-4 pt-5">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="font-weight-bold text-dark mb-0" id="dossierFullName">Dr. Researcher Name</h4>
                            <div class="text-maroon font-weight-bold" id="dossierTitleRank">Full Professor</div>
                            <div class="text-muted small" id="dossierDeptCollege">
                                <i class="fas fa-university me-1"></i> Department of Computer Science (CIT)
                            </div>
                        </div>
                        <div>
                            <span class="badge bg-warning text-dark font-weight-bold px-3 py-2 fs-6" id="dossierBadge">
                                Lead PI
                            </span>
                        </div>
                    </div>

                    <!-- Metrics bar -->
                    <div class="row g-2 mb-4 text-center">
                        <div class="col-3">
                            <div class="p-2 border rounded bg-light">
                                <div class="text-xs text-muted font-weight-bold text-uppercase">Projects</div>
                                <div class="h5 mb-0 font-weight-bold text-maroon" id="dossierProjects">0</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-2 border rounded bg-light">
                                <div class="text-xs text-muted font-weight-bold text-uppercase">Papers</div>
                                <div class="h5 mb-0 font-weight-bold text-maroon" id="dossierPublications">0</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-2 border rounded bg-light">
                                <div class="text-xs text-muted font-weight-bold text-uppercase">h-Index</div>
                                <div class="h5 mb-0 font-weight-bold text-maroon" id="dossierHIndex">0</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-2 border rounded bg-light">
                                <div class="text-xs text-muted font-weight-bold text-uppercase">Citations</div>
                                <div class="h5 mb-0 font-weight-bold text-maroon" id="dossierCitations">0</div>
                            </div>
                        </div>
                    </div>

                    <!-- Specializations -->
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-dark mb-2">
                            <i class="fas fa-microscope text-maroon me-1"></i> Research Specializations & Thrusts
                        </h6>
                        <div id="dossierSpecializations">
                            <!-- Pills injected dynamically -->
                        </div>
                    </div>

                    <!-- Bio -->
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-dark mb-2">
                            <i class="fas fa-file-alt text-maroon me-1"></i> Faculty Biography & Impact
                        </h6>
                        <p class="text-muted small leading-relaxed mb-0" id="dossierBio">
                            No biography provided.
                        </p>
                    </div>

                    <!-- Contact & Identifiers -->
                    <div class="row g-3 pt-3 border-top">
                        <div class="col-md-6">
                            <div class="small text-muted"><i class="far fa-id-badge me-1"></i> ORCID Identifier:</div>
                            <div class="font-weight-bold text-dark" id="dossierOrcid">Not Specified</div>
                        </div>
                        <div class="col-md-6">
                            <div class="small text-muted"><i class="far fa-envelope me-1"></i> Official Email:</div>
                            <div class="font-weight-bold text-dark" id="dossierEmail">Not Specified</div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <a id="dossierEmailBtn" href="#" class="btn btn-maroon btn-sm">
                    <i class="fas fa-paper-plane me-1"></i> Contact Researcher
                </a>
            </div>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- INTERACTIVE JAVASCRIPT (NO JQUERY DEPENDENCY)                                        -->
<!-- ==================================================================================== -->
<script>
    let activeDomainFilter = 'all';

    function filterDomain(domain, element) {
        activeDomainFilter = domain;

        document.querySelectorAll('.filter-tag-pill').forEach(pill => {
            pill.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }

        filterResearchers();
    }

    function filterResearchers() {
        const query = (document.getElementById('mainSearchInput')?.value || '').toLowerCase().trim();
        const selectedCollege = document.getElementById('collegeFilter')?.value || 'all';
        const selectedRank = document.getElementById('rankFilter')?.value || 'all';

        const cards = document.querySelectorAll('.researcher-card-col');
        let visibleCount = 0;

        cards.forEach(card => {
            const cardSearchData = card.getAttribute('data-search') || '';
            const cardCollege = card.getAttribute('data-college') || '';
            const cardRank = card.getAttribute('data-rank') || '';
            const cardDomain = card.getAttribute('data-domain') || '';

            const matchesText = !query || cardSearchData.includes(query);
            const matchesCollege = (selectedCollege === 'all') || (cardCollege.toUpperCase() === selectedCollege.toUpperCase());
            const matchesRank = (selectedRank === 'all') || (cardRank.toLowerCase().includes(selectedRank.toLowerCase()));
            const matchesDomain = (activeDomainFilter === 'all') || (cardDomain.toLowerCase().includes(activeDomainFilter.toLowerCase()));

            if (matchesText && matchesCollege && matchesRank && matchesDomain) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        const emptyNotice = document.getElementById('emptySearchNotice');
        if (emptyNotice) {
            if (visibleCount === 0 && cards.length > 0) {
                emptyNotice.classList.remove('d-none');
            } else {
                emptyNotice.classList.add('d-none');
            }
        }
    }

    function openAddResearcherModal() {
        const modalEl = document.getElementById('addResearcherModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function openProfileModal(data) {
        if (!data) return;

        document.getElementById('dossierFullName').textContent = data.full_name || 'Faculty Member';
        document.getElementById('dossierTitleRank').textContent = data.title_rank || 'Researcher';

        const collegeText = data.college ? ` (${data.college})` : '';
        document.getElementById('dossierDeptCollege').innerHTML = `<i class="fas fa-university me-1"></i> ${data.department || 'Faculty of Research'}${collegeText}`;

        const badgeEl = document.getElementById('dossierBadge');
        if (data.badge_label) {
            badgeEl.textContent = data.badge_label;
            badgeEl.style.display = 'inline-block';
        } else {
            badgeEl.style.display = 'none';
        }

        document.getElementById('dossierProjects').textContent = data.active_projects || '0';
        document.getElementById('dossierPublications').textContent = data.publications_count || '0';
        document.getElementById('dossierHIndex').textContent = 'h-' + (data.h_index || '0');
        document.getElementById('dossierCitations').textContent = (data.citations_count || '0');

        const specsContainer = document.getElementById('dossierSpecializations');
        specsContainer.innerHTML = '';
        if (data.specializations) {
            const list = data.specializations.split(',');
            list.forEach(s => {
                const trimmed = s.trim();
                if (trimmed) {
                    const span = document.createElement('span');
                    span.className = 'spec-pill';
                    span.textContent = trimmed;
                    specsContainer.appendChild(span);
                }
            });
        } else {
            specsContainer.innerHTML = '<span class="text-muted small">No specializations listed.</span>';
        }

        document.getElementById('dossierBio').textContent = data.bio || 'No biography or research summary statement available.';
        document.getElementById('dossierOrcid').textContent = data.orcid || 'Not Specified';

        const emailEl = document.getElementById('dossierEmail');
        const emailBtn = document.getElementById('dossierEmailBtn');
        if (data.email) {
            emailEl.textContent = data.email;
            emailBtn.href = `mailto:${data.email}`;
            emailBtn.style.display = 'inline-block';
        } else {
            emailEl.textContent = 'Not Specified';
            emailBtn.style.display = 'none';
        }

        const modalEl = document.getElementById('researcherDetailModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>