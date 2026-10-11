<div class="container-fluid py-4" id="researchStorageRoot">

    <style>
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
            <span class="hero-badge-tag"><i class="fas fa-database me-1"></i> Institutional Digital Archive</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-hdd me-2 text-warning"></i>Digital Research Storage & Data Repository
            </h1>
            <p class="page-hero-subtitle">
                Upload, organize, and securely share research papers, raw datasets, patent filings, and terminal reports with automated versioning and IP compliance.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-cloud-upload-alt me-1"></i> Upload File
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" data-bs-toggle="modal" data-bs-target="#newFolderModal">
                <i class="fas fa-folder-plus me-1"></i> New Folder
            </button>
        </div>
    </div>

    <!-- Quick Portal Nav Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('/irimkms/proposalsandapprovals') ?>" class="main-nav-pill"><i class="bi bi-file-earmark-check text-maroon me-1"></i> Proposals & Approvals</a>
        <a href="<?= url('/irimkms/researchprojects') ?>" class="main-nav-pill"><i class="bi bi-journal-code text-maroon me-1"></i> Research Projects</a>
        <a href="<?= url('/irimkms/projectmilestone') ?>" class="main-nav-pill"><i class="bi bi-flag text-maroon me-1"></i> Milestones</a>
        <a href="<?= url('/irimkms/implementationprogress') ?>" class="main-nav-pill"><i class="bi bi-hourglass-split text-maroon me-1"></i> Implementation Progress</a>
        <a href="<?= url('/irimkms/fundingandresources') ?>" class="main-nav-pill"><i class="bi bi-cash-coin text-maroon me-1"></i> Grants & Funding</a>
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill"><i class="bi bi-book-half text-maroon me-1"></i> Publications</a>
        <a href="<?= url('/irimkms/searchableresearch') ?>" class="main-nav-pill"><i class="bi bi-search text-maroon me-1"></i> Discovery Engine</a>
        <a href="<?= url('/irimkms/researchstorage') ?>" class="main-nav-pill active"><i class="bi bi-hdd-network text-white me-1"></i> Digital Storage</a>
        <a href="<?= url('/irimkms/filemanagement') ?>" class="main-nav-pill"><i class="bi bi-folder-symlink text-maroon me-1"></i> File Management</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

                    <!-- KPI Cards Row -->
                    <div class="row mb-4">

                        <!-- Storage Capacity Card -->
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card p-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div>
                                        <div class="text-xs font-weight-bold text-uppercase text-muted"
                                            style="letter-spacing:0.05em;">
                                            Storage Quota Used
                                        </div>
                                        <div class="h3 mb-0 font-weight-bold text-gray-800">4.2 TB</div>
                                    </div>
                                    <div class="kpi-icon-box"
                                        style="background-color: #fcf0f2; color: var(--rmis-maroon);">
                                        <i class="fas fa-hdd"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between text-xs font-weight-bold mb-1">
                                        <span class="text-muted">42% of 10 TB allocated</span>
                                        <span class="text-rmis-maroon">5.8 TB Free</span>
                                    </div>
                                    <div class="progress progress-sm rounded-pill" style="height: 6px;">
                                        <div class="progress-bar bg-rmis-maroon" role="progressbar" style="width: 42%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Files Card -->
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-xs font-weight-bold text-uppercase text-muted"
                                            style="letter-spacing:0.05em;">
                                            Total Archived Files
                                        </div>
                                        <div class="h3 mb-0 font-weight-bold text-gray-800">3,840</div>
                                        <div class="small text-success font-weight-bold mt-1">
                                            <i class="fas fa-arrow-up mr-1"></i>+240 files this month
                                        </div>
                                    </div>
                                    <div class="kpi-icon-box" style="background-color: #eff6ff; color: #2563eb;">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Datasets Card -->
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-xs font-weight-bold text-uppercase text-muted"
                                            style="letter-spacing:0.05em;">
                                            Indexed Raw Datasets
                                        </div>
                                        <div class="h3 mb-0 font-weight-bold text-success">612</div>
                                        <div class="small text-muted font-weight-bold mt-1">
                                            Open Access & Confidential
                                        </div>
                                    </div>
                                    <div class="kpi-icon-box" style="background-color: #ecfdf5; color: #059669;">
                                        <i class="fas fa-database"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Downloads Card -->
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="card kpi-card p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-xs font-weight-bold text-uppercase text-muted"
                                            style="letter-spacing:0.05em;">
                                            Downloads & Citations
                                        </div>
                                        <div class="h3 mb-0 font-weight-bold text-info">14.8K</div>
                                        <div class="small text-info font-weight-bold mt-1">
                                            <i class="fas fa-chart-line mr-1"></i>+18% traffic growth
                                        </div>
                                    </div>
                                    <div class="kpi-icon-box" style="background-color: #fffbeb; color: #d97706;">
                                        <i class="fas fa-download"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Category Folder Grid -->
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="font-weight-bold text-rmis-maroon mb-0" style="font-size: 1.05rem;">
                            <i class="fas fa-folder text-rmis-gold mr-2"></i>Storage Categories & Repositories
                        </h6>
                        <span class="text-muted small">5 Main Archives</span>
                    </div>

                    <div class="row mb-4">
                        <!-- Folder 1 -->
                        <div class="col-xl-2 col-md-4 col-6 mb-3">
                            <div class="folder-card">
                                <div class="folder-icon">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div class="font-weight-bold text-dark text-truncate" style="font-size:0.88rem;">
                                    Terminal Reports</div>
                                <div class="text-muted text-xs">1,240 files ₱ 1.4 GB</div>
                            </div>
                        </div>

                        <!-- Folder 2 -->
                        <div class="col-xl-2 col-md-4 col-6 mb-3">
                            <div class="folder-card">
                                <div class="folder-icon" style="background-color: #ecfdf5; color: #059669;">
                                    <i class="fas fa-table"></i>
                                </div>
                                <div class="font-weight-bold text-dark text-truncate" style="font-size:0.88rem;">Raw
                                    Datasets</div>
                                <div class="text-muted text-xs">850 files ₱ 1.8 GB</div>
                            </div>
                        </div>

                        <!-- Folder 3 -->
                        <div class="col-xl-2 col-md-4 col-6 mb-3">
                            <div class="folder-card">
                                <div class="folder-icon" style="background-color: #eff6ff; color: #2563eb;">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="font-weight-bold text-dark text-truncate" style="font-size:0.88rem;">
                                    Publications & DOIs</div>
                                <div class="text-muted text-xs">920 files ₱ 650 MB</div>
                            </div>
                        </div>

                        <!-- Folder 4 -->
                        <div class="col-xl-2 col-md-4 col-6 mb-3">
                            <div class="folder-card">
                                <div class="folder-icon" style="background-color: #fef2f2; color: #dc2626;">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="font-weight-bold text-dark text-truncate" style="font-size:0.88rem;">IP &
                                    Patents</div>
                                <div class="text-muted text-xs">180 files ₱ 220 MB</div>
                            </div>
                        </div>

                        <!-- Folder 5 -->
                        <div class="col-xl-2 col-md-4 col-6 mb-3">
                            <div class="folder-card">
                                <div class="folder-icon" style="background-color: #f3e8ff; color: #9333ea;">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <div class="font-weight-bold text-dark text-truncate" style="font-size:0.88rem;">Grants
                                    & MOUs</div>
                                <div class="text-muted text-xs">650 files ₱ 410 MB</div>
                            </div>
                        </div>

                        <!-- Folder 6 (Add New) -->
                        <div class="col-xl-2 col-md-4 col-6 mb-3">
                            <div class="folder-card d-flex flex-column align-items-center justify-content-center text-center py-3"
                                style="border: 2px dashed #cbd5e1; background: transparent;" data-toggle="modal"
                                data-target="#newFolderModal">
                                <i class="fas fa-plus text-muted mb-2" style="font-size: 1.2rem;"></i>
                                <div class="font-weight-bold text-muted text-xs">Create Collection</div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Storage Explorer Table & Sidebar Widgets Grid -->
                    <div class="row">

                        <!-- Main Table (8 Cols) -->
                        <div class="col-lg-8 mb-4">
                            <div class="card card-custom">

                                <!-- Card Header & Filters -->
                                <div class="card-custom-header">
                                    <div
                                        class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                                        <div>
                                            <h6 class="font-weight-bold text-rmis-maroon mb-1"
                                                style="font-size: 1.05rem;">
                                                <i class="fas fa-hdd mr-2 text-rmis-gold"></i>Digital Repository
                                                Explorer
                                            </h6>
                                            <p class="text-muted small mb-0">Search, filter, and inspect institutional
                                                research files and datasets.</p>
                                        </div>

                                        <!-- Quick Search -->
                                        <div class="input-group input-group-sm" style="width: 260px;">
                                            <input type="text" id="storageSearch" class="form-control bg-light border"
                                                placeholder="Search filename, author, topic...">
                                            <div class="input-group-append">
                                                <button class="btn btn-rmis-maroon" type="button">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Filter Navigation Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom" id="storageFilterTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab-all-files" data-toggle="tab"
                                                href="#all-files" role="tab">
                                                All Storage <span class="badge badge-secondary ml-1">3,840</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-public" data-toggle="tab" href="#public-files"
                                                role="tab">
                                                <i class="fas fa-globe text-success mr-1"></i>Open Access <span
                                                    class="badge badge-success ml-1">2,110</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-faculty" data-toggle="tab" href="#faculty-files"
                                                role="tab">
                                                <i class="fas fa-lock text-warning mr-1"></i>Restricted Faculty <span
                                                    class="badge badge-warning ml-1">1,420</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Card Body / Table -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-custom mb-0" id="storageTable">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>File / Asset Name</th>
                                                    <th>Owner / College</th>
                                                    <th>Size & Version</th>
                                                    <th>Access Level</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <!-- File Row 1 -->
                                                <tr>
                                                    <td>
                                                        <div class="badge-file-type badge-excel">XLSX</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold text-dark">
                                                            Crop_Soil_Moisture_Sensor_Readings_2026.xlsx</div>
                                                        <div class="text-muted text-xs">Project RMIS-2025-088 â€¢ Raw
                                                            IoT Sensor Telemetry Data</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">Mhica Bianca Rodelas</div>
                                                        <div class="text-muted text-xs">College of Engineering</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">42.8 MB</div>
                                                        <div class="text-muted text-xs">v2.1 â€¢ Sep 28, 2026</div>
                                                    </td>
                                                    <td>
                                                        <span class="badge-access access-public">
                                                            <i class="fas fa-globe"></i> Open Access
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-outline-primary"
                                                                data-toggle="modal" data-target="#fileDetailsModal"
                                                                title="Inspect Metadata">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-rmis-maroon"
                                                                onclick="alert('Downloading Crop_Soil_Moisture_Sensor_Readings_2026.xlsx...')"
                                                                title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- File Row 2 -->
                                                <tr>
                                                    <td>
                                                        <div class="badge-file-type badge-pdf">PDF</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold text-dark">
                                                            Final_Terminal_Report_RMIS2025_074.pdf</div>
                                                        <div class="text-muted text-xs">Biomass Conversion Micro-Grids
                                                            Comprehensive Report</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">Prof. Roberto Cruz</div>
                                                        <div class="text-muted text-xs">College of Agriculture</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">18.4 MB</div>
                                                        <div class="text-muted text-xs">v1.0 â€¢ Sep 15, 2026</div>
                                                    </td>
                                                    <td>
                                                        <span class="badge-access access-faculty">
                                                            <i class="fas fa-user-shield"></i> Faculty Only
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-outline-primary"
                                                                data-toggle="modal" data-target="#fileDetailsModal"
                                                                title="Inspect Metadata">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-rmis-maroon"
                                                                onclick="alert('Downloading Final_Terminal_Report_RMIS2025_074.pdf...')"
                                                                title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- File Row 3 -->
                                                <tr>
                                                    <td>
                                                        <div class="badge-file-type badge-zip">ZIP</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold text-dark">
                                                            Botanical_Extract_GCMS_Spectra_Archive.zip</div>
                                                        <div class="text-muted text-xs">High-Resolution Gas
                                                            Chromatography Data Package</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">Dr. Elena Reyes</div>
                                                        <div class="text-muted text-xs">College of Science</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">145.2 MB</div>
                                                        <div class="text-muted text-xs">v1.2 â€¢ Aug 20, 2026</div>
                                                    </td>
                                                    <td>
                                                        <span class="badge-access access-restricted">
                                                            <i class="fas fa-lock"></i> IP Protected
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-outline-primary"
                                                                data-toggle="modal" data-target="#fileDetailsModal"
                                                                title="Inspect Metadata">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-rmis-maroon"
                                                                onclick="alert('Downloading Botanical_Extract_GCMS_Spectra_Archive.zip...')"
                                                                title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- File Row 4 -->
                                                <tr>
                                                    <td>
                                                        <div class="badge-file-type badge-code">PY</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold text-dark">
                                                            AI_Crop_Disease_Classifier_v3.py</div>
                                                        <div class="text-muted text-xs">Python Neural Network Model
                                                            Training Script</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">Mhica Bianca Rodelas</div>
                                                        <div class="text-muted text-xs">College of Engineering</div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold">2.4 MB</div>
                                                        <div class="text-muted text-xs">v3.0 â€¢ Aug 12, 2026</div>
                                                    </td>
                                                    <td>
                                                        <span class="badge-access access-public">
                                                            <i class="fas fa-globe"></i> Open Access
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-outline-primary"
                                                                data-toggle="modal" data-target="#fileDetailsModal"
                                                                title="Inspect Metadata">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-rmis-maroon"
                                                                onclick="alert('Downloading AI_Crop_Disease_Classifier_v3.py...')"
                                                                title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Pagination / Footer -->
                                <div
                                    class="card-footer bg-white d-flex align-items-center justify-content-between py-3">
                                    <div class="text-xs text-muted">
                                        Showing <strong>1 to 4</strong> of 3,840 storage items
                                    </div>
                                    <ul class="pagination pagination-sm mb-0">
                                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item active"><a
                                                class="page-link bg-rmis-maroon border-rmis-maroon" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <!-- Right Widgets Column (4 Cols) -->
                        <div class="col-lg-4">

                            <!-- Drag & Drop Upload Quick Widget -->
                            <div class="card card-custom mb-4">
                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <h6 class="font-weight-bold text-rmis-maroon mb-0">
                                        <i class="fas fa-cloud-upload-alt text-rmis-gold mr-2"></i>Quick Upload Area
                                    </h6>
                                </div>
                                <div class="card-body px-4">
                                    <div class="dropzone-box mb-3" data-toggle="modal" data-target="#uploadModal">
                                        <i class="fas fa-cloud-upload-alt text-rmis-maroon mb-2"
                                            style="font-size: 2.2rem;"></i>
                                        <div class="font-weight-bold text-dark" style="font-size: 0.9rem;">Click or Drag
                                            Files Here</div>
                                        <div class="text-muted text-xs mt-1">Supports PDF, XLSX, ZIP, CSV, IP Packages
                                            up to 500MB</div>
                                    </div>
                                    <button class="btn btn-rmis-gold btn-block font-weight-bold shadow-sm"
                                        data-toggle="modal" data-target="#uploadModal">
                                        <i class="fas fa-plus-circle mr-2"></i>Browse Computer Files
                                    </button>
                                </div>
                            </div>

                            <!-- Storage Breakdown Chart Widget -->
                            <div class="card card-custom mb-4">
                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <h6 class="font-weight-bold text-rmis-maroon mb-0">
                                        <i class="fas fa-chart-pie text-rmis-gold mr-2"></i>Storage Allocation Breakdown
                                    </h6>
                                </div>
                                <div class="card-body px-4">

                                    <!-- Progress Item 1 -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between text-xs font-weight-bold mb-1">
                                            <span class="text-dark"><i class="fas fa-file-pdf text-danger mr-1"></i>PDF
                                                Reports & Papers</span>
                                            <span class="text-rmis-maroon font-weight-bold">1.89 TB (45%)</span>
                                        </div>
                                        <div class="progress progress-sm rounded-pill" style="height: 8px;">
                                            <div class="progress-bar bg-rmis-maroon" role="progressbar"
                                                style="width: 45%"></div>
                                        </div>
                                    </div>

                                    <!-- Progress Item 2 -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between text-xs font-weight-bold mb-1">
                                            <span class="text-dark"><i class="fas fa-table text-success mr-1"></i>Raw
                                                Datasets & Excel</span>
                                            <span class="text-success font-weight-bold">1.47 TB (35%)</span>
                                        </div>
                                        <div class="progress progress-sm rounded-pill" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 35%">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress Item 3 -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between text-xs font-weight-bold mb-1">
                                            <span class="text-dark"><i
                                                    class="fas fa-file-archive text-warning mr-1"></i>ZIP & Compressed
                                                Archives</span>
                                            <span class="text-warning font-weight-bold">504 GB (12%)</span>
                                        </div>
                                        <div class="progress progress-sm rounded-pill" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 12%">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress Item 4 -->
                                    <div>
                                        <div class="d-flex justify-content-between text-xs font-weight-bold mb-1">
                                            <span class="text-dark"><i class="fas fa-code text-info mr-1"></i>Code,
                                                Models & Scripts</span>
                                            <span class="text-info font-weight-bold">336 GB (8%)</span>
                                        </div>
                                        <div class="progress progress-sm rounded-pill" style="height: 8px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 8%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Security & Governance Box -->
                            <div class="card card-custom">
                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <h6 class="font-weight-bold text-rmis-maroon mb-0">
                                        <i class="fas fa-shield-alt text-rmis-gold mr-2"></i>Storage Governance &
                                        Compliance
                                    </h6>
                                </div>
                                <div class="card-body px-4 pt-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="p-2 rounded bg-light mr-3 text-success">
                                            <i class="fas fa-lock fa-lg"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark text-xs">AES-256 Cloud Encryption
                                            </div>
                                            <div class="text-muted text-xs">All stored files encrypted at rest & in
                                                transit.</div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="p-2 rounded bg-light mr-3 text-info">
                                            <i class="fas fa-history fa-lg"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark text-xs">Automated Version Tracking
                                            </div>
                                            <div class="text-muted text-xs">Revert to previous dataset iterations
                                                anytime.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/sidebar_icons.php'; ?>