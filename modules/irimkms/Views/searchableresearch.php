<div class="container-fluid px-4 py-3" id="searchableResearchRoot">

    <!-- CSS Safeguards & Custom Design System Tokens -->
    <style>
        #searchableResearchRoot, #searchableResearchRoot * {
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
            <span class="hero-badge-tag"><i class="fas fa-search me-1"></i> Institutional Discovery & Index Engine</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-search-location me-2 text-warning"></i>Searchable Research Database
            </h1>
            <p class="page-hero-subtitle">
                Instant full-text search across all Marinduque State University research projects, peer-reviewed publications, patent disclosures, and extension outputs.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#advSearchModal">
                <i class="fas fa-sliders-h me-1"></i> Advanced Query Builder
            </button>
            <button class="btn btn-light btn-sm px-3 py-2 text-maroon font-weight-bold" onclick="exportSearchResultsCSV()">
                <i class="fas fa-file-csv me-1"></i> Export Query Results
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
        <a href="<?= url('/irimkms/searchableresearch') ?>" class="main-nav-pill active"><i class="bi bi-search text-white me-1"></i> Discovery Engine</a>
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
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Indexed Research Items</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">4,520 Items</div>
                            <div class="small text-success font-weight-bold mt-1"><i class="fas fa-arrow-up me-1"></i>+320 added this year</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Full-Text Accessible</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">3,890 PDFs</div>
                            <div class="small text-muted font-weight-bold mt-1">86% Open Access Rate</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-pdf fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Monthly Search Queries</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">18,450</div>
                            <div class="small text-success font-weight-bold mt-1"><i class="fas fa-arrow-up me-1"></i>Active Faculty Discovery</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-search fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Indexed Research Thrusts</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">12 Agenda</div>
                            <div class="small text-info font-weight-bold mt-1"><i class="fas fa-globe me-1"></i>100% SDG Tagged</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation View Tabs -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button type="button" class="main-nav-pill active" id="tabNavDiscovery" onclick="switchSearchTab('discovery')">
            <i class="fas fa-search text-maroon"></i> Research Discovery Engine
        </button>
        <button type="button" class="main-nav-pill" id="tabNavAdvanced" onclick="switchSearchTab('advanced')">
            <i class="fas fa-sliders-h text-warning"></i> Advanced Query Builder
        </button>
        <button type="button" class="main-nav-pill" id="tabNavPopular" onclick="switchSearchTab('popular')">
            <i class="fas fa-fire text-info"></i> Popular Topics & Trending Research
        </button>
    </div>


    <!-- ==================================================================================== -->
    <!-- TAB 1: RESEARCH DISCOVERY ENGINE                                                    -->
    <!-- ==================================================================================== -->
    <div id="srSectionDiscovery" class="sr-tab-view">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center g-3">
                    <div class="col-lg-7">
                        <h6 class="font-weight-bold text-maroon mb-1"><i class="fas fa-search me-2 text-warning"></i>Full-Text Discovery Registry</h6>
                        <p class="text-muted small mb-0">Search titles, abstracts, authors, and keywords across the institutional repository.</p>
                    </div>

                    <!-- Search Input -->
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input type="text" id="srSearchInput" class="form-control" placeholder="Search keywords (e.g. AI, Drone, Mangrove, Energy)..." oninput="filterSrTable()">
                            <button class="btn btn-maroon font-weight-bold" type="button"><i class="fas fa-search me-1"></i> Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle small mb-0" id="srTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Research Title & Code</th>
                                <th>Lead Author & Unit</th>
                                <th>Research Thrust</th>
                                <th>Year</th>
                                <th>Access</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-search="ai-driven water quality monitoring mhica bianca rodelas cit it ai prop-2026-001">
                                <td>
                                    <strong class="text-dark d-block">AI-Driven Water Quality Monitoring System for Local Basins</strong>
                                    <small class="text-muted">Code: PROP-2026-001 • Basic Research</small>
                                </td>
                                <td>
                                    <strong class="d-block text-dark">Mhica Bianca Rodelas</strong>
                                    <small class="text-muted">College of Info Tech</small>
                                </td>
                                <td><span class="badge bg-maroon text-white">IT & AI Innovation</span></td>
                                <td>2026</td>
                                <td><span class="badge bg-success">Full-Text Open</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary font-weight-bold" onclick="openAbstractModal('AI-Driven Water Quality Monitoring System', 'Mhica Bianca Rodelas', 'Development of IoT-enabled water sampling node matrix with AI predictive models.')">
                                        <i class="fas fa-eye me-1"></i> Abstract
                                    </button>
                                </td>
                            </tr>

                            <tr data-search="smart agricultural crop pest detection drone gabriel ramos coa agriculture prop-2026-002">
                                <td>
                                    <strong class="text-dark d-block">Smart Agricultural Crop Pest Detection Using Drone Imagery</strong>
                                    <small class="text-muted">Code: PROP-2026-002 • Applied Research</small>
                                </td>
                                <td>
                                    <strong class="d-block text-dark">Prof. Gabriel Ramos</strong>
                                    <small class="text-muted">College of Agriculture</small>
                                </td>
                                <td><span class="badge bg-success">Smart Agriculture</span></td>
                                <td>2025</td>
                                <td><span class="badge bg-success">Full-Text Open</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary font-weight-bold" onclick="openAbstractModal('Smart Agricultural Crop Pest Detection', 'Prof. Gabriel Ramos', 'Utilizing multispectral drone imaging to detect early-stage crop infestations.')">
                                        <i class="fas fa-eye me-1"></i> Abstract
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /#srSectionDiscovery -->


    <!-- ==================================================================================== -->
    <!-- TAB 2: ADVANCED QUERY BUILDER                                                        -->
    <!-- ==================================================================================== -->
    <div id="srSectionAdvanced" class="sr-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-warning">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-maroon"><i class="fas fa-sliders-h me-2"></i>Advanced Query Builder</h5>
            </div>
            <div class="card-body p-4">
                <form onsubmit="handleAdvQuerySubmit(event)">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Keywords in Title / Abstract</label>
                            <input type="text" class="form-control" id="advKw" placeholder="e.g. Telemetry, Machine Learning">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Research Agenda / Thrust</label>
                            <select class="form-select" id="advThrust">
                                <option value="all" selected>All Agenda & Thrusts</option>
                                <option value="IT & AI">IT & AI Innovation</option>
                                <option value="Agriculture">Smart Agriculture</option>
                                <option value="Environment">Environment & Climate</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Author / PI Name</label>
                            <input type="text" class="form-control" id="advAuthor" placeholder="e.g. Dr. Rodelas">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Publication Year Range</label>
                            <select class="form-select" id="advYear">
                                <option value="2026" selected>2026</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-maroon font-weight-bold shadow-sm px-4">
                        <i class="fas fa-search me-1"></i> Execute Query
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /#srSectionAdvanced -->


    <!-- ==================================================================================== -->
    <!-- TAB 3: POPULAR TOPICS                                                                -->
    <!-- ==================================================================================== -->
    <div id="srSectionPopular" class="sr-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-info">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-info"><i class="fas fa-fire me-2"></i>Trending Research Topics</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-maroon p-2 fs-6">Artificial Intelligence</span>
                    <span class="badge bg-gold text-dark p-2 fs-6">IoT Telemetry</span>
                    <span class="badge bg-success p-2 fs-6">Mangrove Ecosystems</span>
                    <span class="badge bg-info p-2 fs-6">Precision Agriculture</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /#srSectionPopular -->

</div>
<!-- /.container-fluid -->

<!-- MODAL 1: ADVANCED SEARCH MODAL -->
<div class="modal fade" id="advSearchModal" tabindex="-1" aria-labelledby="advSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-sliders-h me-2"></i>Advanced Query Builder</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <input type="text" class="form-control mb-2" placeholder="Search Query String">
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm font-weight-bold" onclick="showToast('Query Executed', 'Search query filtered results.')">
                    <i class="fas fa-search me-1"></i> Run Query
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: ABSTRACT MODAL -->
<div class="modal fade" id="abstractModal" tabindex="-1" aria-labelledby="abstractModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-file-alt me-2"></i>Research Abstract</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <h5 class="font-weight-bold text-dark mb-2" id="absTitle">Title</h5>
                <small class="text-muted d-block mb-3" id="absAuthor">Author</small>
                <p class="small text-dark mb-0" id="absText">Abstract text...</p>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
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
    function switchSearchTab(tabKey) {
        document.querySelectorAll('.sr-tab-view').forEach(view => {
            view.classList.add('d-none');
        });
        document.querySelectorAll('.main-nav-pill').forEach(pill => {
            pill.classList.remove('active');
        });

        if (tabKey === 'discovery') {
            document.getElementById('srSectionDiscovery')?.classList.remove('d-none');
            document.getElementById('tabNavDiscovery')?.classList.add('active');
        } else if (tabKey === 'advanced') {
            document.getElementById('srSectionAdvanced')?.classList.remove('d-none');
            document.getElementById('tabNavAdvanced')?.classList.add('active');
        } else if (tabKey === 'popular') {
            document.getElementById('srSectionPopular')?.classList.remove('d-none');
            document.getElementById('tabNavPopular')?.classList.add('active');
        }
    }

    function filterSrTable() {
        const query = (document.getElementById('srSearchInput')?.value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('#srTable tbody tr');

        rows.forEach(row => {
            const rowSearch = row.getAttribute('data-search') || '';
            row.style.display = (!query || rowSearch.includes(query)) ? '' : 'none';
        });
    }

    function openAbstractModal(title, author, abstract) {
        document.getElementById('absTitle').textContent = title;
        document.getElementById('absAuthor').textContent = `Lead PI: ${author}`;
        document.getElementById('absText').textContent = abstract;

        const modalEl = document.getElementById('abstractModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    function handleAdvQuerySubmit(event) {
        event.preventDefault();
        showToast('Query Executed', 'Advanced query results updated.');
        switchSearchTab('discovery');
    }

    function exportSearchResultsCSV() {
        const rows = [["Title", "Author", "Thrust", "Year"]];
        document.querySelectorAll('#srTable tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 4) {
                const title = cells[0]?.querySelector('strong')?.innerText || '';
                const author = cells[1]?.querySelector('strong')?.innerText || '';
                const thrust = cells[2]?.innerText || '';
                const year = cells[3]?.innerText || '';
                rows.push([`"${title}"`, `"${author}"`, `"${thrust}"`, `"${year}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Search_Query_Results_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Export Completed', 'Search results exported to CSV.');
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