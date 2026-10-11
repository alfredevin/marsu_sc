<div class="container-fluid px-4 py-3" id="fileManagementRoot">

    <!-- CSS Safeguards & Custom Design System Tokens -->
    <style>
        #fileManagementRoot, #fileManagementRoot * {
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
            <span class="hero-badge-tag"><i class="fas fa-file-signature me-1"></i> Institutional Document Management</span>
            <h1 class="page-hero-title mb-1">
                <i class="fas fa-folder-open me-2 text-warning"></i>Document & File Management Workspace
            </h1>
            <p class="page-hero-subtitle">
                Organize research proposals, ethics approvals, grant contracts, liquidation records, and institutional MOAs with electronic sign-offs and version control.
            </p>
        </div>
        <div class="mt-3 mt-lg-0 d-flex gap-2">
            <button class="btn btn-gold btn-sm px-3 py-2 font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadDocModal">
                <i class="fas fa-plus-circle me-1"></i> Upload Document
            </button>
            <button class="btn btn-outline-light btn-sm px-3 py-2" data-bs-toggle="modal" data-bs-target="#newFolderModal">
                <i class="fas fa-folder-plus me-1"></i> Create Folder
            </button>
            <button class="btn btn-light btn-sm px-3 py-2 text-maroon font-weight-bold" onclick="exportFileLogCSV()">
                <i class="fas fa-file-csv me-1"></i> Export File Index
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
        <a href="<?= url('/irimkms/filemanagement') ?>" class="main-nav-pill active"><i class="bi bi-folder-symlink text-white me-1"></i> File Management</a>
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
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">Indexed Documents</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">2,480 Files</div>
                            <div class="small text-success font-weight-bold mt-1"><i class="fas fa-arrow-up me-1"></i>+115 files this month</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-contract fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Signed MOAs & Contracts</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">184 MOAs</div>
                            <div class="small text-muted font-weight-bold mt-1">100% Digital Sign-off Verified</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Approval</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">14 Files</div>
                            <div class="small text-warning font-weight-bold mt-1"><i class="fas fa-clock me-1"></i>Awaiting Sign-off</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Encrypted Storage Space</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">124.8 GB</div>
                            <div class="small text-info font-weight-bold mt-1"><i class="fas fa-hdd me-1"></i>42% Capacity Used</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation View Tabs -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button type="button" class="main-nav-pill active" id="tabNavExplorer" onclick="switchFileTab('explorer')">
            <i class="fas fa-folder-open text-maroon"></i> Document Registry Explorer
        </button>
        <button type="button" class="main-nav-pill" id="tabNavUpload" onclick="switchFileTab('upload')">
            <i class="fas fa-cloud-upload-alt text-warning"></i> Document Upload & Categorization
        </button>
        <button type="button" class="main-nav-pill" id="tabNavAudit" onclick="switchFileTab('audit')">
            <i class="fas fa-history text-info"></i> Archival Audit & Version History
        </button>
    </div>


    <!-- ==================================================================================== -->
    <!-- TAB 1: DOCUMENT REGISTRY EXPLORER                                                   -->
    <!-- ==================================================================================== -->
    <div id="fileSectionExplorer" class="file-tab-view">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h6 class="font-weight-bold text-maroon mb-1"><i class="fas fa-list-alt me-2 text-warning"></i>Document Registry</h6>
                        <p class="text-muted small mb-0">Browse, download, and manage institutional files and signed contracts.</p>
                    </div>

                    <!-- Search -->
                    <div class="input-group input-group-sm" style="max-width: 280px;">
                        <input type="text" id="fileSearchInput" class="form-control" placeholder="Search file title or keyword..." oninput="filterFilesTable()">
                        <span class="input-group-text bg-maroon text-white"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle small mb-0" id="fileTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>Document Name</th>
                                <th>Category</th>
                                <th>Uploaded By</th>
                                <th>Date & Version</th>
                                <th>Access Level</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-search="gaa-grant-contract-2026.pdf contract approved research directorate">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                        <div>
                                            <strong class="text-dark d-block">GAA-Grant-Contract-2026.pdf</strong>
                                            <small class="text-muted">Size: 4.2 MB • PDF Document</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-maroon text-white">Grant Contracts</span></td>
                                <td>Research Directorate</td>
                                <td>Oct 02, 2026 <small class="text-muted">v2.1</small></td>
                                <td><span class="badge bg-success">Approved / Public</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary font-weight-bold me-1" onclick="showToast('Downloading', 'Downloading GAA-Grant-Contract-2026.pdf')">
                                        <i class="fas fa-download me-1"></i> Download
                                    </button>
                                </td>
                            </tr>
                            <tr data-search="ethics-clearance-irb-094.pdf ethics irb compliance">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                        <div>
                                            <strong class="text-dark d-block">Ethics-Clearance-IRB-094.pdf</strong>
                                            <small class="text-muted">Size: 1.8 MB • PDF Document</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-info text-white">Ethics Clearances</span></td>
                                <td>IRB Panel Secretariat</td>
                                <td>Sep 28, 2026 <small class="text-muted">v1.0</small></td>
                                <td><span class="badge bg-success">Approved / Public</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary font-weight-bold me-1" onclick="showToast('Downloading', 'Downloading Ethics-Clearance-IRB-094.pdf')">
                                        <i class="fas fa-download me-1"></i> Download
                                    </button>
                                </td>
                            </tr>
                            <tr data-search="moa-dost-gia-agriculture.pdf moa contract partner">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-word text-primary fa-2x me-3"></i>
                                        <div>
                                            <strong class="text-dark d-block">MOA-DOST-GIA-Agriculture.docx</strong>
                                            <small class="text-muted">Size: 2.4 MB • Word Document</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning text-dark">Institutional MOAs</span></td>
                                <td>TTO Legal Office</td>
                                <td>Sep 15, 2026 <small class="text-muted">v3.0</small></td>
                                <td><span class="badge bg-warning text-dark">Under Review</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary font-weight-bold me-1" onclick="showToast('Downloading', 'Downloading MOA-DOST-GIA-Agriculture.docx')">
                                        <i class="fas fa-download me-1"></i> Download
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /#fileSectionExplorer -->


    <!-- ==================================================================================== -->
    <!-- TAB 2: DOCUMENT UPLOAD WORKSPACE                                                     -->
    <!-- ==================================================================================== -->
    <div id="fileSectionUpload" class="file-tab-view d-none">
        <div class="card shadow-sm mb-4 border-left-maroon">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-maroon"><i class="fas fa-cloud-upload-alt me-2"></i>Upload Document Package</h5>
            </div>
            <div class="card-body p-4">
                <form onsubmit="handleUploadSubmit(event)">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Document Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="upTitle" placeholder="e.g. Q3 Financial Liquidation Report" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-dark">Document Category</label>
                            <select class="form-select" id="upCategory">
                                <option value="Grant Contracts">Grant Contracts</option>
                                <option value="Ethics Clearances" selected>Ethics Clearances</option>
                                <option value="Institutional MOAs">Institutional MOAs</option>
                                <option value="Terminal Accomplishments">Terminal Accomplishments</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label font-weight-bold text-dark">File Attachment <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-maroon font-weight-bold shadow-sm px-4">
                        <i class="fas fa-upload me-1"></i> Upload File to Repository
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /#fileSectionUpload -->


    <!-- ==================================================================================== -->
    <!-- TAB 3: ARCHIVAL AUDIT & VERSION HISTORY                                              -->
    <!-- ==================================================================================== -->
    <div id="fileSectionAudit" class="file-tab-view d-none">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-maroon"><i class="fas fa-history me-2"></i>Archival Audit & Version Control Feed</h5>
            </div>
            <div class="card-body p-4">
                <div class="timeline-item">
                    <strong class="text-dark d-block">GAA-Grant-Contract-2026.pdf updated to v2.1</strong>
                    <small class="text-muted">Uploaded by Research Directorate • Oct 02, 2026</small>
                </div>
                <div class="timeline-item">
                    <strong class="text-dark d-block">Ethics-Clearance-IRB-094.pdf created v1.0</strong>
                    <small class="text-muted">Uploaded by IRB Panel Secretariat • Sep 28, 2026</small>
                </div>
            </div>
        </div>
    </div>
    <!-- /#fileSectionAudit -->

</div>
<!-- /.container-fluid -->

<!-- MODAL 1: UPLOAD MODAL -->
<div class="modal fade" id="uploadDocModal" tabindex="-1" aria-labelledby="uploadDocModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle me-2"></i>Upload New Document</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-dark small">Select file from local storage to upload to central repository.</p>
                <input type="file" class="form-control mb-3">
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm font-weight-bold" onclick="showToast('Upload Started', 'Document uploading to server...')">
                    <i class="fas fa-upload me-1"></i> Upload Now
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: NEW FOLDER MODAL -->
<div class="modal fade" id="newFolderModal" tabindex="-1" aria-labelledby="newFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-folder-plus me-2"></i>Create New Directory</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <label class="form-label font-weight-bold text-dark">Folder Name</label>
                <input type="text" class="form-control" placeholder="e.g. FY 2026 Audit Reports">
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-maroon btn-sm font-weight-bold" onclick="showToast('Folder Created', 'New directory initialized.')">
                    <i class="fas fa-folder me-1"></i> Create Directory
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
    function switchFileTab(tabKey) {
        document.querySelectorAll('.file-tab-view').forEach(view => {
            view.classList.add('d-none');
        });
        document.querySelectorAll('.main-nav-pill').forEach(pill => {
            pill.classList.remove('active');
        });

        if (tabKey === 'explorer') {
            document.getElementById('fileSectionExplorer')?.classList.remove('d-none');
            document.getElementById('tabNavExplorer')?.classList.add('active');
        } else if (tabKey === 'upload') {
            document.getElementById('fileSectionUpload')?.classList.remove('d-none');
            document.getElementById('tabNavUpload')?.classList.add('active');
        } else if (tabKey === 'audit') {
            document.getElementById('fileSectionAudit')?.classList.remove('d-none');
            document.getElementById('tabNavAudit')?.classList.add('active');
        }
    }

    function filterFilesTable() {
        const query = (document.getElementById('fileSearchInput')?.value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('#fileTable tbody tr');

        rows.forEach(row => {
            const rowSearch = row.getAttribute('data-search') || '';
            row.style.display = (!query || rowSearch.includes(query)) ? '' : 'none';
        });
    }

    function handleUploadSubmit(event) {
        event.preventDefault();
        const title = document.getElementById('upTitle').value;
        showToast('Document Uploaded', `${title} uploaded successfully.`);
        switchFileTab('explorer');
    }

    function exportFileLogCSV() {
        const rows = [["File Title", "Category", "Uploader", "Date", "Status"]];
        document.querySelectorAll('#fileTable tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 5) {
                const title = cells[0]?.querySelector('strong')?.innerText || '';
                const category = cells[1]?.innerText || '';
                const uploader = cells[2]?.innerText || '';
                const date = cells[3]?.innerText || '';
                const status = cells[4]?.innerText || '';
                rows.push([`"${title}"`, `"${category}"`, `"${uploader}"`, `"${date}"`, `"${status}"`]);
            }
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Document_Index_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Export Completed', 'File registry index exported to CSV.');
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