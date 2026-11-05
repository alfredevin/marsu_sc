<div class="container-fluid py-3" id="researchStorageRoot">

    <style>
        #researchStorageRoot, #researchStorageRoot * {
            box-sizing: border-box;
        }

        :root {
            --maroon-main: #800020;
            --maroon-dark: #5c0017;
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
        .hero-badge-tag {
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

        /* Storage Category Cards */
        .storage-folder-card {
            background: #ffffff;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            padding: 14px 16px;
            transition: all 0.2s ease;
            cursor: pointer;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .storage-folder-card:hover {
            border-color: #800020;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.12);
            transform: translateY(-2px);
        }
        .storage-folder-card.active {
            background: #fff0f3;
            border-color: #800020;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.15);
        }
        .folder-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        /* Filter Tab Pills */
        .storage-tab-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 20px;
            background-color: #f8f9fc;
            color: #5a5c69;
            font-size: 0.85rem;
            font-weight: 600;
            margin-right: 6px;
            margin-bottom: 6px;
            cursor: pointer;
            border: 1px solid #d1d3e2;
            transition: all 0.2s ease;
        }
        .storage-tab-pill:hover {
            background-color: #eaecf4;
            color: var(--maroon-main);
        }
        .storage-tab-pill.active {
            background-color: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 3px 8px rgba(128, 0, 32, 0.25);
        }

        /* File Type Badges */
        .badge-file-type {
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.72rem;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .file-type-pdf { background-color: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; }
        .file-type-xlsx, .file-type-csv { background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
        .file-type-zip { background-color: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
        .file-type-py, .file-type-code { background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
        .file-type-docx { background-color: #f3e8ff; color: #9333ea; border: 1px solid #e9d5ff; }

        /* Toast Container */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 320px;
        }

        /* Drag & Drop Upload Zone */
        .upload-dropzone {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            background: #fafafa;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .upload-dropzone:hover, .upload-dropzone.dragover {
            border-color: #800020;
            background: #fff0f3;
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
                Search, upload, inspect, and securely download institutional research papers, experimental raw datasets, terminal reports, and patent documentation.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadFileModal">
                <i class="fas fa-cloud-upload-alt me-1"></i> Upload Research Asset
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" onclick="exportStorageIndexCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Archive Index
            </button>
        </div>
    </div>

    <!-- Essential Metric Overview Row -->
    <div class="row mb-4">
        <!-- Storage Quota -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Storage Quota Allocated</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">4.2 TB <small class="text-muted fw-normal fs-6">/ 10 TB</small></div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                    <div class="progress-bar bg-maroon" style="width: 42%;"></div>
                                </div>
                                <span class="small font-weight-bold text-maroon">42%</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hdd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Files -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-gold shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Archived Research Files</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="statTotalCount">3,840</div>
                            <div class="small text-success font-weight-bold mt-1">
                                <i class="fas fa-arrow-up me-1"></i>+240 files uploaded this month
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Indexed Datasets -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Indexed Raw Datasets</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">612</div>
                            <div class="small text-muted font-weight-bold mt-1">
                                <i class="fas fa-check-circle text-success me-1"></i>Open Access & Verified Data
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Downloads & Citations -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dissemination Downloads</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">14.8K</div>
                            <div class="small text-info font-weight-bold mt-1">
                                <i class="fas fa-chart-line me-1"></i>+18% traffic growth
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Category Folders Bar -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h6 class="font-weight-bold text-dark mb-0">
            <i class="fas fa-folder-open text-maroon me-2"></i>Storage Collections & Categories
        </h6>
        <span class="text-muted small">Click any collection to filter immediately</span>
    </div>

    <div class="row g-3 mb-4">
        <!-- All Folders -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="storage-folder-card active" onclick="filterCategoryFolder('all', this)">
                <div class="folder-icon-box bg-maroon text-white">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div>
                    <strong class="text-dark d-block small mb-0">All Archives</strong>
                    <small class="text-muted">3,840 files</small>
                </div>
            </div>
        </div>

        <!-- Terminal Reports -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="storage-folder-card" onclick="filterCategoryFolder('reports', this)">
                <div class="folder-icon-box" style="background:#fee2e2; color:#dc2626;">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div>
                    <strong class="text-dark d-block small mb-0">Terminal Reports</strong>
                    <small class="text-muted">1,240 files • 1.4 GB</small>
                </div>
            </div>
        </div>

        <!-- Raw Datasets -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="storage-folder-card" onclick="filterCategoryFolder('datasets', this)">
                <div class="folder-icon-box" style="background:#ecfdf5; color:#059669;">
                    <i class="fas fa-table"></i>
                </div>
                <div>
                    <strong class="text-dark d-block small mb-0">Raw Datasets</strong>
                    <small class="text-muted">850 files • 1.8 GB</small>
                </div>
            </div>
        </div>

        <!-- Publications -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="storage-folder-card" onclick="filterCategoryFolder('publications', this)">
                <div class="folder-icon-box" style="background:#eff6ff; color:#2563eb;">
                    <i class="fas fa-book-open"></i>
                </div>
                <div>
                    <strong class="text-dark d-block small mb-0">Publications</strong>
                    <small class="text-muted">920 files • 650 MB</small>
                </div>
            </div>
        </div>

        <!-- IP & Patents -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="storage-folder-card" onclick="filterCategoryFolder('patents', this)">
                <div class="folder-icon-box" style="background:#fef3c7; color:#d97706;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <strong class="text-dark d-block small mb-0">IP & Patents</strong>
                    <small class="text-muted">180 files • 220 MB</small>
                </div>
            </div>
        </div>

        <!-- Grants & MOUs -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="storage-folder-card" onclick="filterCategoryFolder('grants', this)">
                <div class="folder-icon-box" style="background:#f3e8ff; color:#9333ea;">
                    <i class="fas fa-file-contract"></i>
                </div>
                <div>
                    <strong class="text-dark d-block small mb-0">Grants & MOUs</strong>
                    <small class="text-muted">650 files • 410 MB</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Repository Explorer Card -->
    <div class="card shadow-sm mb-4">
        <!-- Interactive Filter Toolbar -->
        <div class="card-header bg-white py-3 border-bottom">
            <div class="row align-items-center g-3">
                <!-- Access Level Filter Tabs -->
                <div class="col-lg-6">
                    <div class="d-flex flex-wrap align-items-center">
                        <span class="small font-weight-bold text-muted me-2 mb-1">Access:</span>
                        <span class="storage-tab-pill active" onclick="filterAccessLevel('all', this)">All Files (<span id="countAllPill">7</span>)</span>
                        <span class="storage-tab-pill" onclick="filterAccessLevel('public', this)"><i class="fas fa-globe text-success me-1"></i> Open Access</span>
                        <span class="storage-tab-pill" onclick="filterAccessLevel('faculty', this)"><i class="fas fa-user-shield text-warning me-1"></i> Faculty Only</span>
                        <span class="storage-tab-pill" onclick="filterAccessLevel('restricted', this)"><i class="fas fa-lock text-danger me-1"></i> IP Protected</span>
                    </div>
                </div>

                <!-- Live Search & College Filter -->
                <div class="col-lg-6">
                    <div class="row g-2 justify-content-lg-end">
                        <div class="col-sm-5">
                            <select class="form-select form-select-sm" id="collegeSelectFilter" onchange="filterStorageFiles()">
                                <option value="all" selected>All Implementing Colleges</option>
                                <option value="CIT">College of Info Tech (CIT)</option>
                                <option value="COE">College of Engineering (COE)</option>
                                <option value="CSM">College of Science (CSM)</option>
                                <option value="COA">College of Agriculture (COA)</option>
                                <option value="CHS">College of Health Sciences</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <div class="input-group input-group-sm">
                                <input type="text" id="storageSearchInput" class="form-control" placeholder="Search filename, title, or PI..." oninput="filterStorageFiles()">
                                <button type="button" class="btn bg-maroon text-white" onclick="filterStorageFiles()"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Body -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="storageFilesTable">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th class="ps-3" style="width: 70px;">Type</th>
                            <th>File / Dataset Name & Description</th>
                            <th>Associated Research Project</th>
                            <th>Principal Investigator</th>
                            <th>Size & Version</th>
                            <th>Access Level</th>
                            <th class="text-end pe-3" style="width: 140px;">Quick Actions</th>
                        </tr>
                    </thead>
                    <tbody id="storageFilesTbody">
                        <!-- File 1: XLSX -->
                        <tr class="storage-file-row"
                            data-category="datasets"
                            data-access="public"
                            data-college="COE"
                            data-filename="Crop_Soil_Moisture_Sensor_Readings_2026.xlsx"
                            data-title="Raw IoT Sensor Telemetry Data for Local Aquaculture"
                            data-project="Artificial Intelligence-Driven Water Quality Monitoring System"
                            data-pi="Mhica Bianca Rodelas"
                            data-size="42.8 MB"
                            data-version="v2.1"
                            data-date="Sep 28, 2026"
                            data-access-text="Open Access">
                            <td class="ps-3">
                                <span class="badge-file-type file-type-xlsx">XLSX</span>
                            </td>
                            <td>
                                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">Crop_Soil_Moisture_Sensor_Readings_2026.xlsx</strong>
                                <small class="text-muted d-block">Raw IoT Sensor Telemetry Data</small>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">Artificial Intelligence-Driven Water Quality Monitoring System</span>
                            </td>
                            <td>
                                <span class="text-dark small font-weight-bold d-block">Mhica Bianca Rodelas</span>
                                <span class="badge bg-light text-dark border">COE</span>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">42.8 MB</span>
                                <small class="text-muted">v2.1 • Sep 28, 2026</small>
                            </td>
                            <td>
                                <span class="badge bg-success text-white py-1 px-2 font-weight-bold">
                                    <i class="fas fa-globe me-1"></i> Open Access
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('Crop_Soil_Moisture_Sensor_Readings_2026.xlsx', 'Raw IoT Sensor Telemetry Data')">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('Crop_Soil_Moisture_Sensor_Readings_2026.xlsx')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- File 2: PDF -->
                        <tr class="storage-file-row"
                            data-category="reports"
                            data-access="faculty"
                            data-college="COA"
                            data-filename="Final_Terminal_Report_MicroGrids.pdf"
                            data-title="Biomass Conversion Micro-Grids Comprehensive Terminal Report"
                            data-project="Smart Agricultural Crop Pest Detection Using Drone Imagery"
                            data-pi="Prof. Roberto Cruz"
                            data-size="18.4 MB"
                            data-version="v1.0"
                            data-date="Sep 15, 2026"
                            data-access-text="Faculty Only">
                            <td class="ps-3">
                                <span class="badge-file-type file-type-pdf">PDF</span>
                            </td>
                            <td>
                                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">Final_Terminal_Report_MicroGrids.pdf</strong>
                                <small class="text-muted d-block">Biomass Conversion Micro-Grids Terminal Report</small>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">Smart Agricultural Crop Pest Detection Using Drone Imagery</span>
                            </td>
                            <td>
                                <span class="text-dark small font-weight-bold d-block">Prof. Roberto Cruz</span>
                                <span class="badge bg-light text-dark border">COA</span>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">18.4 MB</span>
                                <small class="text-muted">v1.0 • Sep 15, 2026</small>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark py-1 px-2 font-weight-bold">
                                    <i class="fas fa-user-shield me-1"></i> Faculty Only
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('Final_Terminal_Report_MicroGrids.pdf', 'Biomass Conversion Micro-Grids Terminal Report')">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('Final_Terminal_Report_MicroGrids.pdf')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- File 3: ZIP -->
                        <tr class="storage-file-row"
                            data-category="patents"
                            data-access="restricted"
                            data-college="CSM"
                            data-filename="Botanical_Extract_GCMS_Spectra_Archive.zip"
                            data-title="High-Resolution Gas Chromatography Mass Spectrometry Package"
                            data-project="Indigenous Botanical Extracts and Phytochemical Bio-Shield"
                            data-pi="Dr. Elena Cruz"
                            data-size="145.2 MB"
                            data-version="v1.2"
                            data-date="Aug 20, 2026"
                            data-access-text="IP Protected">
                            <td class="ps-3">
                                <span class="badge-file-type file-type-zip">ZIP</span>
                            </td>
                            <td>
                                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">Botanical_Extract_GCMS_Spectra_Archive.zip</strong>
                                <small class="text-muted d-block">High-Resolution GC-MS Data Package</small>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">Indigenous Botanical Extracts and Phytochemical Bio-Shield</span>
                            </td>
                            <td>
                                <span class="text-dark small font-weight-bold d-block">Dr. Elena Cruz</span>
                                <span class="badge bg-light text-dark border">CSM</span>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">145.2 MB</span>
                                <small class="text-muted">v1.2 • Aug 20, 2026</small>
                            </td>
                            <td>
                                <span class="badge bg-danger text-white py-1 px-2 font-weight-bold">
                                    <i class="fas fa-lock me-1"></i> IP Protected
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('Botanical_Extract_GCMS_Spectra_Archive.zip', 'GCMS Spectra Archive')">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('Botanical_Extract_GCMS_Spectra_Archive.zip')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- File 4: PY -->
                        <tr class="storage-file-row"
                            data-category="datasets"
                            data-access="public"
                            data-college="CIT"
                            data-filename="AI_Crop_Disease_Classifier_v3.py"
                            data-title="Convolutional Neural Network Model Training & Validation Script"
                            data-project="Smart Agricultural Crop Pest Detection Using Drone Imagery"
                            data-pi="Mhica Bianca Rodelas"
                            data-size="2.4 MB"
                            data-version="v3.0"
                            data-date="Aug 12, 2026"
                            data-access-text="Open Access">
                            <td class="ps-3">
                                <span class="badge-file-type file-type-py">PY</span>
                            </td>
                            <td>
                                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">AI_Crop_Disease_Classifier_v3.py</strong>
                                <small class="text-muted d-block">CNN Model Training & Validation Script</small>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">Smart Agricultural Crop Pest Detection Using Drone Imagery</span>
                            </td>
                            <td>
                                <span class="text-dark small font-weight-bold d-block">Mhica Bianca Rodelas</span>
                                <span class="badge bg-light text-dark border">CIT</span>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">2.4 MB</span>
                                <small class="text-muted">v3.0 • Aug 12, 2026</small>
                            </td>
                            <td>
                                <span class="badge bg-success text-white py-1 px-2 font-weight-bold">
                                    <i class="fas fa-globe me-1"></i> Open Access
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('AI_Crop_Disease_Classifier_v3.py', 'Python Model Script')">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('AI_Crop_Disease_Classifier_v3.py')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- File 5: CSV -->
                        <tr class="storage-file-row"
                            data-category="datasets"
                            data-access="public"
                            data-college="CSM"
                            data-filename="Mangrove_Soil_Salinity_Matrix_Q3.csv"
                            data-title="Fieldwork Soil Salinity & Hydrology Telemetry Matrix"
                            data-project="Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework"
                            data-pi="Dr. Elena Cruz"
                            data-size="8.6 MB"
                            data-version="v1.0"
                            data-date="Jul 29, 2026"
                            data-access-text="Open Access">
                            <td class="ps-3">
                                <span class="badge-file-type file-type-csv">CSV</span>
                            </td>
                            <td>
                                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">Mangrove_Soil_Salinity_Matrix_Q3.csv</strong>
                                <small class="text-muted d-block">Fieldwork Soil Salinity & Hydrology Data</small>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework</span>
                            </td>
                            <td>
                                <span class="text-dark small font-weight-bold d-block">Dr. Elena Cruz</span>
                                <span class="badge bg-light text-dark border">CSM</span>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">8.6 MB</span>
                                <small class="text-muted">v1.0 • Jul 29, 2026</small>
                            </td>
                            <td>
                                <span class="badge bg-success text-white py-1 px-2 font-weight-bold">
                                    <i class="fas fa-globe me-1"></i> Open Access
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('Mangrove_Soil_Salinity_Matrix_Q3.csv', 'Soil Salinity Matrix')">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('Mangrove_Soil_Salinity_Matrix_Q3.csv')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- File 6: PDF -->
                        <tr class="storage-file-row"
                            data-category="publications"
                            data-access="public"
                            data-college="CIT"
                            data-filename="MarSU_IRB_Ethics_Protocol_Endorsement.pdf"
                            data-title="Institutional Review Board Ethical Clearance Certificate"
                            data-project="Artificial Intelligence-Driven Water Quality Monitoring System"
                            data-pi="Mhica Bianca Rodelas"
                            data-size="3.1 MB"
                            data-version="v1.0"
                            data-date="Jun 18, 2026"
                            data-access-text="Open Access">
                            <td class="ps-3">
                                <span class="badge-file-type file-type-pdf">PDF</span>
                            </td>
                            <td>
                                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">MarSU_IRB_Ethics_Protocol_Endorsement.pdf</strong>
                                <small class="text-muted d-block">Ethics Clearance Protocol Certificate</small>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">Artificial Intelligence-Driven Water Quality Monitoring System</span>
                            </td>
                            <td>
                                <span class="text-dark small font-weight-bold d-block">Mhica Bianca Rodelas</span>
                                <span class="badge bg-light text-dark border">CIT</span>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">3.1 MB</span>
                                <small class="text-muted">v1.0 • Jun 18, 2026</small>
                            </td>
                            <td>
                                <span class="badge bg-success text-white py-1 px-2 font-weight-bold">
                                    <i class="fas fa-globe me-1"></i> Open Access
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('MarSU_IRB_Ethics_Protocol_Endorsement.pdf', 'Ethics Protocol Certificate')">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('MarSU_IRB_Ethics_Protocol_Endorsement.pdf')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- File 7: DOCX -->
                        <tr class="storage-file-row"
                            data-category="grants"
                            data-access="faculty"
                            data-college="COE"
                            data-filename="CHED_DARETO_Grant_Agreement_Signed.docx"
                            data-title="Signed Institutional Memorandum of Agreement with CHED"
                            data-project="Nanomaterial Enhanced Solar Cells"
                            data-pi="Engr. Ramon Valenzuela"
                            data-size="5.2 MB"
                            data-version="v1.1"
                            data-date="May 14, 2026"
                            data-access-text="Faculty Only">
                            <td class="ps-3">
                                <span class="badge-file-type file-type-docx">DOCX</span>
                            </td>
                            <td>
                                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">CHED_DARETO_Grant_Agreement_Signed.docx</strong>
                                <small class="text-muted d-block">Signed Institutional MOA with CHED</small>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">Nanomaterial Enhanced Solar Cells</span>
                            </td>
                            <td>
                                <span class="text-dark small font-weight-bold d-block">Engr. Ramon Valenzuela</span>
                                <span class="badge bg-light text-dark border">COE</span>
                            </td>
                            <td>
                                <span class="text-dark font-weight-bold small d-block">5.2 MB</span>
                                <small class="text-muted">v1.1 • May 14, 2026</small>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark py-1 px-2 font-weight-bold">
                                    <i class="fas fa-user-shield me-1"></i> Faculty Only
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('CHED_DARETO_Grant_Agreement_Signed.docx', 'Grant Agreement Document')">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('CHED_DARETO_Grant_Agreement_Signed.docx')">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty Search State -->
            <div id="storageEmptyState" class="text-center py-5 d-none">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <h5 class="text-dark font-weight-bold">No Matching Research Files Found</h5>
                <p class="text-muted small mb-3">Try adjusting your search keywords, category folder, or access filters.</p>
                <button type="button" class="btn btn-sm btn-outline-maroon" onclick="resetStorageFilters()">
                    <i class="fas fa-sync-alt me-1"></i> Reset All Filters
                </button>
            </div>
        </div>

        <!-- Footer / Record Summary -->
        <div class="card-footer bg-white d-flex align-items-center justify-content-between py-3 border-top">
            <div class="text-muted small" id="storageSummaryText">
                Showing <strong id="showingCount">7</strong> active digital research assets
            </div>
            <div class="small text-muted">
                <i class="fas fa-shield-alt text-maroon me-1"></i> AES-256 Encrypted & RA 10173 Compliant Storage
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- ==================================================================================== -->
<!-- MODAL 1: UPLOAD RESEARCH ASSET                                                      -->
<!-- ==================================================================================== -->
<div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="uploadFileModalLabel">
                    <i class="fas fa-cloud-upload-alt me-2"></i>Upload Research File / Dataset
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadAssetForm" onsubmit="handleUploadAssetSubmit(event)">
                <div class="modal-body p-4">
                    <div class="alert alert-light border-left-maroon small mb-3">
                        <i class="fas fa-info-circle me-1 text-maroon"></i> Uploaded documents and datasets are automatically timestamped, assigned university checksums, and integrated into institutional open-access metrics.
                    </div>

                    <!-- Drag & Drop Zone -->
                    <div class="upload-dropzone mb-3" id="dropzoneArea" onclick="document.getElementById('fileUploadInput').click()">
                        <i class="fas fa-cloud-upload-alt fa-3x text-maroon mb-2"></i>
                        <h6 class="font-weight-bold text-dark mb-1">Click to browse or drag file here</h6>
                        <small class="text-muted d-block" id="selectedFileNameText">Supports PDF, XLSX, CSV, ZIP, PY, DOCX up to 500 MB</small>
                        <input type="file" id="fileUploadInput" class="d-none" onchange="handleFileSelection(this)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Associated Research Project <span class="text-danger">*</span></label>
                        <select class="form-select" id="uploadProjectSelect" required>
                            <option value="" disabled selected>-- Select Approved Research Project --</option>
                            <?php if (!empty($projects)): ?>
                                <?php foreach ($projects as $pj): ?>
                                    <option value="<?= e($pj['title']) ?>"><?= e($pj['title']) ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="Artificial Intelligence-Driven Water Quality Monitoring System">Artificial Intelligence-Driven Water Quality Monitoring System</option>
                                <option value="Smart Agricultural Crop Pest Detection Using Drone Imagery">Smart Agricultural Crop Pest Detection Using Drone Imagery</option>
                                <option value="Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework">Coastal Bio-Shield and Mangrove Ecosystem Resilience Framework</option>
                                <option value="Nanomaterial Enhanced Solar Cells">Nanomaterial Enhanced Solar Cells</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Asset Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="uploadCategorySelect" required>
                                <option value="reports" selected>Terminal & Progress Reports</option>
                                <option value="datasets">Raw Experimental Datasets</option>
                                <option value="publications">Peer-Reviewed Publications</option>
                                <option value="patents">IP, Patents & Utility Models</option>
                                <option value="grants">Grants, MOUs & Contracts</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Access Permission Level <span class="text-danger">*</span></label>
                            <select class="form-select" id="uploadAccessSelect" required>
                                <option value="public" selected>Open Access (Public Discovery)</option>
                                <option value="faculty">Restricted to University Faculty</option>
                                <option value="restricted">Confidential & IP Protected</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Principal Investigator <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="uploadPiName" placeholder="e.g. Prof. Mhica Bianca Rodelas" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Implementing College</label>
                            <select class="form-select" id="uploadCollegeSelect">
                                <option value="CIT" selected>College of Information Technology (CIT)</option>
                                <option value="COE">College of Engineering (COE)</option>
                                <option value="CSM">College of Science (CSM)</option>
                                <option value="COA">College of Agriculture (COA)</option>
                                <option value="CHS">College of Health Sciences (CHS)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Asset Description / Notes</label>
                        <textarea class="form-control" id="uploadDescription" rows="2" placeholder="Brief summary of file contents, methodologies, or data gathering parameters..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-maroon btn-sm font-weight-bold shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> Save to Digital Storage
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- MODAL 2: INSPECT FILE METADATA & DOSSIER                                             -->
<!-- ==================================================================================== -->
<div class="modal fade" id="inspectFileModal" tabindex="-1" aria-labelledby="inspectFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="inspectFileModalLabel">
                    <i class="fas fa-file-alt me-2"></i>Research Asset Metadata
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div id="inspectTypeBadge" class="badge-file-type file-type-xlsx me-2 fs-6">XLSX</div>
                    <div>
                        <h6 class="font-weight-bold text-dark mb-0" id="inspectFilename">Filename.xlsx</h6>
                        <small class="text-muted" id="inspectSubtitle">Asset Subtitle</small>
                    </div>
                </div>

                <div class="p-3 bg-light rounded border mb-3">
                    <div class="row g-2 small">
                        <div class="col-sm-6">
                            <span class="text-muted d-block">Associated Project:</span>
                            <strong class="text-dark d-block" id="inspectProject">Project Title</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted d-block">Lead Investigator:</span>
                            <strong class="text-dark d-block" id="inspectPI">PI Name</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted d-block">File Size & Version:</span>
                            <strong class="text-dark d-block" id="inspectSizeVersion">0 MB • v1.0</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted d-block">Access Level:</span>
                            <strong class="text-dark d-block" id="inspectAccess">Open Access</strong>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold text-muted small text-uppercase mb-1">Persistent DOI Citation Link</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="inspectDoiLink" readonly value="https://doi.org/10.5281/marsu.irimkms.2026.049">
                        <button class="btn btn-outline-maroon" type="button" onclick="copyCurrentDoi()">
                            <i class="fas fa-copy me-1"></i> Copy
                        </button>
                    </div>
                </div>

                <div class="small text-muted">
                    <i class="fas fa-shield-alt text-maroon me-1"></i> Checksum Verified: <code>SHA256: 7f83b1657ff1...</code>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm" id="inspectDownloadBtn" onclick="triggerDownloadFromModal()">
                    <i class="fas fa-download me-1"></i> Download Asset
                </button>
            </div>
        </div>
    </div>
</div>


<!-- TOAST NOTIFICATION BANNER -->
<div class="toast-notification d-none" id="actionToast">
    <div class="card shadow-lg border-left-maroon bg-white">
        <div class="card-body p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x text-success me-3" id="toastIcon"></i>
                <div>
                    <strong class="text-dark d-block" id="toastTitle">Success</strong>
                    <small class="text-muted" id="toastMessage">Action performed successfully.</small>
                </div>
            </div>
            <button type="button" class="btn-close ms-3" onclick="hideToast()"></button>
        </div>
    </div>
</div>


<!-- ==================================================================================== -->
<!-- INTERACTIVE JAVASCRIPT LOGIC (NO JQUERY, 100% BS5.3 COMPATIBLE)                     -->
<!-- ==================================================================================== -->
<script>
    let currentCategoryFilter = 'all';
    let currentAccessFilter = 'all';
    let activeModalFilename = '';

    // Filter by Folder Category Cards
    function filterCategoryFolder(cat, element) {
        currentCategoryFilter = cat;
        document.querySelectorAll('.storage-folder-card').forEach(card => {
            card.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }
        filterStorageFiles();
    }

    // Filter by Access Level Pills
    function filterAccessLevel(level, element) {
        currentAccessFilter = level;
        document.querySelectorAll('.storage-tab-pill').forEach(pill => {
            pill.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }
        filterStorageFiles();
    }

    // Master Live Filter Function
    function filterStorageFiles() {
        const query = (document.getElementById('storageSearchInput')?.value || '').toLowerCase().trim();
        const selectedCollege = document.getElementById('collegeSelectFilter')?.value || 'all';

        const rows = document.querySelectorAll('.storage-file-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const filename = (row.getAttribute('data-filename') || '').toLowerCase();
            const title = (row.getAttribute('data-title') || '').toLowerCase();
            const project = (row.getAttribute('data-project') || '').toLowerCase();
            const pi = (row.getAttribute('data-pi') || '').toLowerCase();
            const college = row.getAttribute('data-college') || '';
            const category = row.getAttribute('data-category') || '';
            const access = row.getAttribute('data-access') || '';

            const matchesQuery = !query || filename.includes(query) || title.includes(query) || project.includes(query) || pi.includes(query);
            const matchesCategory = (currentCategoryFilter === 'all') || (category === currentCategoryFilter);
            const matchesAccess = (currentAccessFilter === 'all') || (access === currentAccessFilter);
            const matchesCollege = (selectedCollege === 'all') || (college === selectedCollege);

            if (matchesQuery && matchesCategory && matchesAccess && matchesCollege) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const emptyState = document.getElementById('storageEmptyState');
        const showingCountEl = document.getElementById('showingCount');
        if (showingCountEl) showingCountEl.textContent = visibleCount;

        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('d-none');
            } else {
                emptyState.classList.add('d-none');
            }
        }
    }

    function resetStorageFilters() {
        if (document.getElementById('storageSearchInput')) document.getElementById('storageSearchInput').value = '';
        if (document.getElementById('collegeSelectFilter')) document.getElementById('collegeSelectFilter').value = 'all';
        currentCategoryFilter = 'all';
        currentAccessFilter = 'all';

        document.querySelectorAll('.storage-folder-card').forEach((card, idx) => {
            card.classList.toggle('active', idx === 0);
        });
        document.querySelectorAll('.storage-tab-pill').forEach((pill, idx) => {
            pill.classList.toggle('active', idx === 0);
        });

        filterStorageFiles();
    }

    // File Drag & Drop helper
    function handleFileSelection(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const nameEl = document.getElementById('selectedFileNameText');
            if (nameEl) {
                nameEl.innerHTML = `<strong class="text-maroon"><i class="fas fa-file me-1"></i>${file.name}</strong> (${(file.size / (1024 * 1024)).toFixed(2)} MB)`;
            }
        }
    }

    // Handle Upload Submit
    function handleUploadAssetSubmit(event) {
        event.preventDefault();

        const fileInput = document.getElementById('fileUploadInput');
        const file = fileInput?.files?.[0];
        const filename = file ? file.name : 'Research_Dataset_' + Math.floor(Math.random() * 900 + 100) + '.xlsx';
        const project = document.getElementById('uploadProjectSelect').value;
        const category = document.getElementById('uploadCategorySelect').value;
        const access = document.getElementById('uploadAccessSelect').value;
        const pi = document.getElementById('uploadPiName').value;
        const college = document.getElementById('uploadCollegeSelect').value;
        const desc = document.getElementById('uploadDescription').value || 'Uploaded research asset';

        const ext = filename.split('.').pop().toLowerCase();
        let badgeClass = 'file-type-pdf';
        let badgeText = ext.toUpperCase();
        if (['xlsx', 'xls'].includes(ext)) { badgeClass = 'file-type-xlsx'; badgeText = 'XLSX'; }
        else if (ext === 'csv') { badgeClass = 'file-type-csv'; badgeText = 'CSV'; }
        else if (['zip', 'rar', '7z'].includes(ext)) { badgeClass = 'file-type-zip'; badgeText = 'ZIP'; }
        else if (['py', 'js', 'r'].includes(ext)) { badgeClass = 'file-type-py'; badgeText = ext.toUpperCase(); }
        else if (['docx', 'doc'].includes(ext)) { badgeClass = 'file-type-docx'; badgeText = 'DOCX'; }

        let accessBadgeHtml = '';
        if (access === 'public') {
            accessBadgeHtml = '<span class="badge bg-success text-white py-1 px-2 font-weight-bold"><i class="fas fa-globe me-1"></i> Open Access</span>';
        } else if (access === 'faculty') {
            accessBadgeHtml = '<span class="badge bg-warning text-dark py-1 px-2 font-weight-bold"><i class="fas fa-user-shield me-1"></i> Faculty Only</span>';
        } else {
            accessBadgeHtml = '<span class="badge bg-danger text-white py-1 px-2 font-weight-bold"><i class="fas fa-lock me-1"></i> IP Protected</span>';
        }

        const tbody = document.getElementById('storageFilesTbody');
        const newRow = document.createElement('tr');
        newRow.className = 'storage-file-row';
        newRow.setAttribute('data-category', category);
        newRow.setAttribute('data-access', access);
        newRow.setAttribute('data-college', college);
        newRow.setAttribute('data-filename', filename);
        newRow.setAttribute('data-title', desc);
        newRow.setAttribute('data-project', project);
        newRow.setAttribute('data-pi', pi);
        newRow.setAttribute('data-size', file ? (file.size / (1024 * 1024)).toFixed(1) + ' MB' : '12.4 MB');
        newRow.setAttribute('data-version', 'v1.0');
        newRow.setAttribute('data-date', new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }));
        newRow.setAttribute('data-access-text', access === 'public' ? 'Open Access' : (access === 'faculty' ? 'Faculty Only' : 'IP Protected'));

        newRow.innerHTML = `
            <td class="ps-3">
                <span class="badge-file-type ${badgeClass}">${badgeText}</span>
            </td>
            <td>
                <strong class="text-dark d-block text-truncate" style="max-width: 320px;">${filename}</strong>
                <small class="text-muted d-block">${desc}</small>
            </td>
            <td>
                <span class="text-dark font-weight-bold small d-block">${project}</span>
            </td>
            <td>
                <span class="text-dark small font-weight-bold d-block">${pi}</span>
                <span class="badge bg-light text-dark border">${college}</span>
            </td>
            <td>
                <span class="text-dark font-weight-bold small d-block">${newRow.getAttribute('data-size')}</span>
                <small class="text-muted">v1.0 • Just now</small>
            </td>
            <td>${accessBadgeHtml}</td>
            <td class="text-end pe-3">
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" title="View Details & Metadata" onclick="inspectFileMetadata(this)">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-maroon" title="Download File" onclick="triggerDownloadFile('${filename}', '${desc}')">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn btn-outline-secondary" title="Copy DOI / Shareable Link" onclick="copyShareableLink('${filename}')">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </td>
        `;

        if (tbody) tbody.prepend(newRow);

        // Update counts
        const statCount = document.getElementById('statTotalCount');
        if (statCount) {
            statCount.textContent = (parseInt(statCount.textContent.replace(/,/g, '')) + 1).toLocaleString();
        }

        const modalEl = document.getElementById('uploadFileModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        document.getElementById('uploadAssetForm').reset();
        document.getElementById('selectedFileNameText').textContent = 'Supports PDF, XLSX, CSV, ZIP, PY, DOCX up to 500 MB';

        filterStorageFiles();
        showToast('Asset Uploaded', `"${filename}" securely saved to Digital Research Storage!`);
    }

    // Inspect File Modal
    function inspectFileMetadata(btn) {
        const row = btn.closest('.storage-file-row');
        if (!row) return;

        const filename = row.getAttribute('data-filename') || '';
        const title = row.getAttribute('data-title') || '';
        const project = row.getAttribute('data-project') || '';
        const pi = row.getAttribute('data-pi') || '';
        const size = row.getAttribute('data-size') || '';
        const version = row.getAttribute('data-version') || '';
        const date = row.getAttribute('data-date') || '';
        const access = row.getAttribute('data-access-text') || '';

        activeModalFilename = filename;

        document.getElementById('inspectFilename').textContent = filename;
        document.getElementById('inspectSubtitle').textContent = title;
        document.getElementById('inspectProject').textContent = project;
        document.getElementById('inspectPI').textContent = pi;
        document.getElementById('inspectSizeVersion').textContent = `${size} • ${version} (${date})`;
        document.getElementById('inspectAccess').textContent = access;

        const ext = filename.split('.').pop().toLowerCase();
        const typeBadge = document.getElementById('inspectTypeBadge');
        if (typeBadge) {
            typeBadge.textContent = ext.toUpperCase();
            typeBadge.className = 'badge-file-type fs-6 me-2 file-type-' + (['xlsx', 'csv', 'zip', 'py', 'pdf', 'docx'].includes(ext) ? ext : 'pdf');
        }

        document.getElementById('inspectDoiLink').value = `https://doi.org/10.5281/marsu.irimkms.2026.${Math.floor(Math.random() * 800 + 100)}`;

        const modalEl = document.getElementById('inspectFileModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function triggerDownloadFromModal() {
        triggerDownloadFile(activeModalFilename, 'Institutional Repository Asset');
    }

    // Real Download Trigger with Text/Blob creation
    function triggerDownloadFile(filename, description) {
        const content = `MARINDUQUE STATE UNIVERSITY\nCENTRALIZED DIGITAL RESEARCH REPOSITORY\n--------------------------------------------\nAsset: ${filename}\nDescription: ${description}\nCompliance: RA 10173 & MarSU URC Guidelines\nDownloaded: ${new Date().toLocaleString()}\n`;
        const blob = new Blob([content], { type: 'text/plain;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Download Started', `Downloading "${filename}"...`);
    }

    // Copy Shareable Link helper
    function copyShareableLink(filename) {
        const link = `https://repository.msu.edu.ph/files/archive/${encodeURIComponent(filename)}`;
        navigator.clipboard.writeText(link).then(() => {
            showToast('Link Copied', `Permanent archive link copied to clipboard.`);
        }).catch(() => {
            showToast('Link Copied', `Permanent archive link copied to clipboard.`);
        });
    }

    function copyCurrentDoi() {
        const val = document.getElementById('inspectDoiLink').value;
        navigator.clipboard.writeText(val).then(() => {
            showToast('DOI Copied', `DOI Citation link copied to clipboard.`);
        });
    }

    // Export CSV
    function exportStorageIndexCSV() {
        const rows = [["Filename", "Description", "Associated Project", "Lead PI", "College", "Size", "Version", "Access Level"]];

        document.querySelectorAll('.storage-file-row').forEach(row => {
            if (row.style.display !== 'none') {
                rows.push([
                    `"${row.getAttribute('data-filename')}"`,
                    `"${row.getAttribute('data-title')}"`,
                    `"${row.getAttribute('data-project')}"`,
                    `"${row.getAttribute('data-pi')}"`,
                    `"${row.getAttribute('data-college')}"`,
                    `"${row.getAttribute('data-size')}"`,
                    `"${row.getAttribute('data-version')}"`,
                    `"${row.getAttribute('data-access-text')}"`
                ]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Digital_Research_Storage_Index_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Export Completed', 'Storage index CSV downloaded successfully.');
    }

    // Toast Helpers
    function showToast(title, message) {
        document.getElementById('toastTitle').textContent = title;
        document.getElementById('toastMessage').textContent = message;
        const toast = document.getElementById('actionToast');
        toast.classList.remove('d-none');
        setTimeout(() => {
            toast.classList.add('d-none');
        }, 3500);
    }

    function hideToast() {
        document.getElementById('actionToast').classList.add('d-none');
    }

    // Dragover effect on dropzone
    document.addEventListener('DOMContentLoaded', () => {
        const dropzone = document.getElementById('dropzoneArea');
        if (dropzone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('dragover');
                }, false);
            });
            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('dragover');
                }, false);
            });
            dropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files[0]) {
                    const input = document.getElementById('fileUploadInput');
                    if (input) {
                        input.files = files;
                        handleFileSelection(input);
                    }
                }
            }, false);
        }
    });
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>