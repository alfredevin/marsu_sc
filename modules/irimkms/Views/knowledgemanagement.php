<div class="container-fluid px-4 py-3" id="knowledgeManagementRoot">

    <!-- CSS Safeguards & Custom Design System Tokens -->
    <style>
        #knowledgeManagementRoot, #knowledgeManagementRoot * {
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

        .btn-maroon {
            background-color: var(--maroon-main);
            border-color: var(--maroon-main);
            color: #fff;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-maroon:hover, .btn-maroon:focus {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: #fff;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.25);
        }

        .btn-gold {
            background-color: var(--gold-accent);
            border-color: var(--gold-accent);
            color: #212529;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-gold:hover, .btn-gold:focus {
            background-color: #c09e2e;
            border-color: #c09e2e;
            color: #111;
        }

        /* Page Hero Banner */
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
            width: 300px;
            height: 300px;
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

        /* Nav Pills Header */
        .main-nav-pill {
            padding: 10px 22px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            color: #495057;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            transition: all 0.25s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .main-nav-pill:hover {
            background-color: var(--maroon-light);
            color: var(--maroon-main);
            border-color: rgba(128, 0, 32, 0.3);
        }
        .main-nav-pill.active {
            background: var(--maroon-main);
            color: #ffffff;
            border-color: var(--maroon-main);
            box-shadow: 0 4px 14px rgba(128, 0, 32, 0.3);
        }

        /* Toast Container */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1080;
            min-width: 300px;
        }
    </style>

    <!-- Page Hero Banner -->
    <div class="page-hero d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="hero-badge-tag"><i class="fas fa-book-open me-1"></i> Institutional Repository Hub</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-layer-group me-2 text-warning"></i>Knowledge Management & Library
            </h1>
            <p class="page-hero-subtitle">
                Centralized digital repository for research documents, publications, datasets, and institutional knowledge — browse, upload, search, and manage all research assets.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadAssetModal">
                <i class="fas fa-cloud-upload-alt me-1"></i> Upload Asset
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" data-bs-toggle="modal" data-bs-target="#addPublicationModal">
                <i class="fas fa-plus-circle me-1"></i> Add Publication
            </button>
            <button class="btn btn-light btn-sm px-3 py-2 text-maroon font-weight-bold" onclick="exportKnowledgeIndexCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Index
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
        <a href="<?= url('/irimkms/knowledgemanagement') ?>" class="main-nav-pill active"><i class="bi bi-book-half text-white me-1"></i> Publications & Library</a>
        <a href="<?= url('/irimkms/searchableresearch') ?>" class="main-nav-pill"><i class="bi bi-search text-maroon me-1"></i> Discovery Engine</a>
        <a href="<?= url('/irimkms/evaluationforms') ?>" class="main-nav-pill"><i class="bi bi-clipboard-data text-maroon me-1"></i> Evaluation Tools</a>
        <a href="<?= url('/irimkms/completionreporting') ?>" class="main-nav-pill"><i class="bi bi-award text-maroon me-1"></i> Completion Reports</a>
        <a href="<?= url('/irimkms/performanceindicators') ?>" class="main-nav-pill"><i class="bi bi-graph-up-arrow text-maroon me-1"></i> Performance Analytics</a>
    </div>

    <!-- KPI Summary Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-maroon shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Archived Documents</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">2,841 Files</div>
                            <div class="small text-success font-weight-bold mt-1"><i class="fas fa-arrow-up me-1"></i>+124 this month</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hdd fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Publications Archived</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">487 Papers</div>
                            <div class="small text-muted font-weight-bold mt-1"><i class="fas fa-star text-warning me-1"></i>58 Scopus/WoS Indexed</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cumulative Downloads</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">14,280</div>
                            <div class="small text-success font-weight-bold mt-1"><i class="fas fa-arrow-up me-1"></i>High Citations Impact</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cloud-download-alt fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Public Access Assets</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">1,920 Assets</div>
                            <div class="small text-info font-weight-bold mt-1"><i class="fas fa-globe me-1"></i>Open Access Compliant</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-globe fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation View Tabs -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button type="button" class="main-nav-pill active" id="tabNavLibrary" onclick="switchKnowledgeTab('library')">
            <i class="fas fa-layer-group text-maroon"></i> Knowledge Assets Library
        </button>
        <button type="button" class="main-nav-pill" id="tabNavAddPub" onclick="switchKnowledgeTab('addpub')">
            <i class="fas fa-plus-circle text-warning"></i> Add Publication Entry
        </button>
        <button type="button" class="main-nav-pill" id="tabNavAnalytics" onclick="switchKnowledgeTab('analytics')">
            <i class="fas fa-chart-line text-info"></i> Citation & Download Analytics
        </button>
    </div>


    <!-- ==================================================================================== -->
    <!-- TAB 1: KNOWLEDGE ASSETS LIBRARY                                                      -->
    <!-- ==================================================================================== -->
    <div id="kmSectionLibrary" class="km-tab-view">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h6 class="font-weight-bold text-maroon mb-1"><i class="fas fa-book me-2 text-warning"></i>Institutional Repository Assets</h6>
                        <p class="text-muted small mb-0">Search and access published research papers, books, and patents.</p>
                    </div>

                    <!-- Search Input -->
                    <div class="input-group input-group-sm" style="max-width: 280px;">
                        <input type="text" id="kmSearchInput" class="form-control" placeholder="Search publication title, author, DOI..." oninput="filterKmTable()">
                        <span class="input-group-text bg-maroon text-white"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle small mb-0" id="kmTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Title & DOI</th>
                                <th>Authors & Unit</th>
                                <th>Publication Type</th>
                                <th>Year</th>
                                <th>Citations</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-search="ai-based water quality monitoring mhica bianca rodelas scopus doi:10.1016/j.env.2026.012">
                                <td>
                                    <strong class="text-dark d-block">AI-Based Water Quality Monitoring in Island River Basins</strong>
                                    <small class="text-muted">DOI: 10.1016/j.env.2026.012</small>
                                </td>
                                <td>
                                    <strong class="d-block text-dark">Mhica Bianca Rodelas et al.</strong>
                                    <small class="text-muted">College of Information Tech</small>
                                </td>
                                <td><span class="badge bg-success">Scopus Journal Paper</span></td>
                                <td>2026</td>
                                <td><span class="badge bg-gold text-dark font-weight-bold">24 Citations</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary font-weight-bold" onclick="showToast('Downloading Asset', 'Downloading PDF fulltext...')">
                                        <i class="fas fa-download me-1"></i> Fulltext
                                    </button>
                                </td>
                            </tr>

                            <tr data-search="smart agricultural crop pest detection gabriel ramos agriculture doi:10.1016/j.agr.2025.044">
                                <td>
                                    <strong class="text-dark d-block">Smart Agricultural Crop Pest Detection Using Multispectral Drones</strong>
                                    <small class="text-muted">DOI: 10.1016/j.agr.2025.044</small>
                                </td>
                                <td>
                                    <strong class="d-block text-dark">Prof. Gabriel Ramos</strong>
                                    <small class="text-muted">College of Agriculture</small>
                                </td>
                                <td><span class="badge bg-success">WoS Journal Paper</span></td>
                                <td>2025</td>
                                <td><span class="badge bg-gold text-dark font-weight-bold">18 Citations</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary font-weight-bold" onclick="showToast('Downloading Asset', 'Downloading PDF fulltext...')">
                                        <i class="fas fa-download me-1"></i> Fulltext
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /#kmSectionLibrary -->


    <!-- ==================================================================================== -->
    <!-- TAB 2: ADD PUBLICATION ENTRY                                                         -->
    <!-- ==================================================================================== -->
    <div id="kmSectionAddPub" class="km-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-maroon">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-maroon"><i class="fas fa-plus-circle me-2"></i>Register New Publication Entry</h5>
            </div>
            <div class="card-body p-4">
                <form onsubmit="handleAddPubSubmit(event)">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label font-weight-bold text-dark">Publication Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pubTitle" placeholder="e.g. Nanomaterial Coatings for Solar Efficiency" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-dark">Publication Type</label>
                            <select class="form-select" id="pubType">
                                <option value="Scopus Journal">Scopus / WoS Journal Paper</option>
                                <option value="CHED Journal">CHED Accredited Journal</option>
                                <option value="Book Chapter">Book / Book Chapter</option>
                                <option value="Patent">Patent / Utility Model</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Authors <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pubAuthors" placeholder="e.g. Dr. Ramon Valenzuela, Engr. Ana Lim" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">DOI / URL</label>
                            <input type="text" class="form-control" id="pubDoi" placeholder="e.g. 10.1016/j.solener.2026...">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-maroon font-weight-bold shadow-sm px-4">
                        <i class="fas fa-save me-1"></i> Register Publication to Repository
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /#kmSectionAddPub -->


    <!-- ==================================================================================== -->
    <!-- TAB 3: CITATION & DOWNLOAD ANALYTICS                                                 -->
    <!-- ==================================================================================== -->
    <div id="kmSectionAnalytics" class="km-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-info">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-info"><i class="fas fa-chart-line me-2"></i>Citation Metrics & Repository Telemetry</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded border">
                            <h6 class="font-weight-bold text-dark mb-2">Top Cited Publications</h6>
                            <ul class="list-group list-group-flush small">
                                <li class="list-group-item bg-transparent d-flex justify-content-between">
                                    <span>AI-Based Water Quality Monitoring</span>
                                    <strong class="text-maroon">24 Citations</strong>
                                </li>
                                <li class="list-group-item bg-transparent d-flex justify-content-between">
                                    <span>Smart Agricultural Crop Pest Detection</span>
                                    <strong class="text-maroon">18 Citations</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded border text-center">
                            <h6 class="font-weight-bold text-dark mb-2">Repository Open Access Rate</h6>
                            <div class="h2 font-weight-bold text-success mb-1">84.5%</div>
                            <span class="badge bg-success">CHED Compliant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#kmSectionAnalytics -->

</div>
<!-- /.container-fluid -->

<!-- MODAL 1: UPLOAD ASSET MODAL -->
<div class="modal fade" id="uploadAssetModal" tabindex="-1" aria-labelledby="uploadAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-cloud-upload-alt me-2"></i>Upload Repository Asset</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <input type="file" class="form-control mb-3">
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm font-weight-bold" onclick="showToast('Asset Uploaded', 'Repository file uploaded.')">
                    <i class="fas fa-upload me-1"></i> Upload Now
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: ADD PUBLICATION MODAL -->
<div class="modal fade" id="addPublicationModal" tabindex="-1" aria-labelledby="addPublicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle me-2"></i>Add Publication Entry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <input type="text" class="form-control mb-2" placeholder="Publication Title">
                <input type="text" class="form-control mb-2" placeholder="Authors">
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm font-weight-bold" onclick="showToast('Publication Added', 'New paper recorded.')">
                    <i class="fas fa-save me-1"></i> Save Publication
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
                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                <div>
                    <strong class="text-dark d-block" id="toastTitle">Success</strong>
                    <small class="text-muted" id="toastMessage">Action performed successfully.</small>
                </div>
            </div>
            <button type="button" class="btn-close ms-3" onclick="hideToast()"></button>
        </div>
    </div>
</div>

<script>
    function switchKnowledgeTab(tabKey) {
        document.querySelectorAll('.km-tab-view').forEach(view => {
            view.classList.add('d-none');
        });
        document.querySelectorAll('.main-nav-pill').forEach(pill => {
            pill.classList.remove('active');
        });

        if (tabKey === 'library') {
            document.getElementById('kmSectionLibrary')?.classList.remove('d-none');
            document.getElementById('tabNavLibrary')?.classList.add('active');
        } else if (tabKey === 'addpub') {
            document.getElementById('kmSectionAddPub')?.classList.remove('d-none');
            document.getElementById('tabNavAddPub')?.classList.add('active');
        } else if (tabKey === 'analytics') {
            document.getElementById('kmSectionAnalytics')?.classList.remove('d-none');
            document.getElementById('tabNavAnalytics')?.classList.add('active');
        }
    }

    function filterKmTable() {
        const query = (document.getElementById('kmSearchInput')?.value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('#kmTable tbody tr');

        rows.forEach(row => {
            const rowSearch = row.getAttribute('data-search') || '';
            row.style.display = (!query || rowSearch.includes(query)) ? '' : 'none';
        });
    }

    function handleAddPubSubmit(event) {
        event.preventDefault();
        const title = document.getElementById('pubTitle').value;
        showToast('Publication Added', `${title} registered into knowledge repository.`);
        switchKnowledgeTab('library');
    }

    function exportKnowledgeIndexCSV() {
        const rows = [["Title", "Authors", "Type", "Year", "Citations"]];
        document.querySelectorAll('#kmTable tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 5) {
                const title = cells[0]?.querySelector('strong')?.innerText || '';
                const authors = cells[1]?.querySelector('strong')?.innerText || '';
                const type = cells[2]?.innerText || '';
                const year = cells[3]?.innerText || '';
                const cit = cells[4]?.innerText || '';
                rows.push([`"${title}"`, `"${authors}"`, `"${type}"`, `"${year}"`, `"${cit}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Knowledge_Repository_Index_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Export Completed', 'Knowledge repository index exported to CSV.');
    }

    function showToast(title, message) {
        document.getElementById('toastTitle').textContent = title;
        document.getElementById('toastMessage').textContent = message;
        const toast = document.getElementById('actionToast');
        toast.classList.remove('d-none');
        setTimeout(() => {
            toast.classList.add('d-none');
        }, 4000);
    }

    function hideToast() {
        document.getElementById('actionToast').classList.add('d-none');
    }
</script>

<?php include __DIR__ . '/sidebar_icons.php'; ?>