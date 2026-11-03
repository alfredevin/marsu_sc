<!-- Socio-Economic Background Management -->
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .fixed-table {
            table-layout: fixed !important;
            width: 100% !important;
        }

        .fixed-table td, .fixed-table th {
            vertical-align: middle;
            white-space: nowrap;
        }

        .fixed-table td.truncate-cell {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Single-Row Compact Search Pill Input */
        .search-pill-wrapper-short {
            background-color: #fcfcfd;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 5px 14px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            width: 220px !important;
            max-width: 240px !important;
            flex-shrink: 0;
        }

        .search-pill-wrapper-short:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.15rem rgba(88, 17, 26, 0.15);
            background-color: #ffffff;
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 0.85rem;
            color: #495057;
            width: 100%;
        }

        /* Filter Select Dropdowns */
        .filter-select {
            width: auto !important;
            min-width: 130px;
            max-width: 155px;
            font-size: 0.85rem !important;
            padding: 5px 8px !important;
            border-radius: 6px !important;
        }

        /* Custom Badges & Status Pills */
        .badge-category {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            background-color: #f8f9fa !important;
            color: #495057 !important;
            border: 1px solid #dcdcdc !important;
            display: inline-block !important;
        }

        .status-badge-review {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffc107 !important;
            display: inline-block !important;
        }

        .status-badge-reviewed {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
            background-color: #d4edda !important;
            color: #0f5132 !important;
            border: 1px solid #198754 !important;
            display: inline-block !important;
        }

        /* Buttons */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 6px 14px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fcfcfd;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
        }
    </style>

    <!-- Breadcrumb & Header Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-house me-1 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">SOCIO-ECONOMIC BACKGROUND</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-3">
        <h4 class="fw-bold marsu-maroon-text mb-1">Socio-economic Background</h4>
        <p class="text-muted small mb-0">Record and review students' household, financial, and living circumstances to help identify appropriate institutional support.</p>
    </div>

    <!-- Filter and Search Toolbar (Single-Row Aligned) -->
    <div class="card border-0 bg-light p-2.5 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Pill Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="socioSearch" class="search-pill-input" placeholder="Search student name or ID..." oninput="applySocioFilters()" autocomplete="off">
            </div>

            <!-- 2. Financial Category Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                <select class="form-select form-select-sm filter-select" id="financialFilter" onchange="applySocioFilters()">
                    <option value="">All Categories</option>
                    <option value="Low income">Low income</option>
                    <option value="Moderate income">Moderate income</option>
                    <option value="High income">High income</option>
                </select>
            </div>

            <!-- 3. Review Status Filter -->
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Status:</label>
                <select class="form-select form-select-sm filter-select" id="statusFilter" onchange="applySocioFilters()">
                    <option value="">All Statuses</option>
                    <option value="For review">For review</option>
                    <option value="Reviewed">Reviewed</option>
                </select>
            </div>

            <!-- 4. Add Background Record Button -->
            <button type="button" class="btn btn-maroon-primary flex-shrink-0" onclick="openAddBackgroundModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add Background Record
            </button>

        </div>
    </div>

    <!-- Socio-Economic Master Directory Table -->
    <div class="table-responsive bg-white rounded border shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0 fixed-table" id="socioTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%; white-space: normal !important; vertical-align: middle;">Student ID</th>
                    <th class="py-3" style="width: 18%; white-space: normal !important; vertical-align: middle;">Student Name</th>
                    <th class="py-3 text-center" style="width: 10%; white-space: normal !important; vertical-align: middle;">Household Size</th>
                    <th class="py-3" style="width: 22%; white-space: normal !important; vertical-align: middle;">Primary Income Source</th>
                    <th class="py-3" style="width: 14%; white-space: normal !important; vertical-align: middle;">Financial Category</th>
                    <th class="py-3" style="width: 14%; white-space: normal !important; vertical-align: middle;">Living Arrangement</th>
                    <th class="py-3 text-center pe-3" style="width: 10%; white-space: normal !important; vertical-align: middle;">Review Status</th>
                </tr>
            </thead>
            <tbody class="small" id="socioTableBody">
                <tr class="socio-row" data-id="26s0041" data-name="adamos, mariedhen l." data-category="Low income" data-status="For review">
                    <td class="ps-3 fw-semibold text-secondary">26S0041</td>
                    <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                    <td class="text-center fw-semibold text-dark">5</td>
                    <td class="text-muted truncate-cell">Parent/guardian employment</td>
                    <td><span class="badge-category">Low income</span></td>
                    <td class="text-muted">With family</td>
                    <td class="text-center pe-3"><span class="status-badge-review">For review</span></td>
                </tr>
                <tr class="socio-row" data-id="26s0087" data-name="ali, kyla diane m." data-category="Moderate income" data-status="Reviewed">
                    <td class="ps-3 fw-semibold text-secondary">26S0087</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td class="text-center fw-semibold text-dark">4</td>
                    <td class="text-muted truncate-cell">Small business</td>
                    <td><span class="badge-category">Moderate income</span></td>
                    <td class="text-muted">With family</td>
                    <td class="text-center pe-3"><span class="status-badge-reviewed">Reviewed</span></td>
                </tr>
                <tr class="socio-row" data-id="26s0095" data-name="almonte, hanz andrei r." data-category="Low income" data-status="For review">
                    <td class="ps-3 fw-semibold text-secondary">26S0095</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td class="text-center fw-semibold text-dark">6</td>
                    <td class="text-muted truncate-cell">Daily wage</td>
                    <td><span class="badge-category">Low income</span></td>
                    <td class="text-muted">Boarding house</td>
                    <td class="text-center pe-3"><span class="status-badge-review">For review</span></td>
                </tr>

                <!-- Fallback empty results row -->
                <tr id="noSocioRecordsRow" style="display: none;">
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No socio-economic records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Data Scope & Privacy Notice Banner -->
    <div class="card border-0 bg-light rounded-3 p-3">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-shield-lock-fill marsu-maroon-text fs-4 flex-shrink-0"></i>
            <div>
                <h6 class="fw-bold text-dark mb-1">Captured Socio-economic Information</h6>
                <p class="text-muted small mb-0">
                    Includes household members and dependents, guardian occupation, estimated income range, scholarship or financial-aid status, housing arrangement, access to food and transportation, and date last reviewed. Keep sensitive details confidential and accessible only to authorized staff.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: ADD SOCIO-ECONOMIC RECORD -->
<div class="modal fade" id="addSocioModal" tabindex="-1" aria-labelledby="addSocioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header marsu-maroon-bg text-white">
                <h5 class="modal-title fw-bold fs-6" id="addSocioModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Add Background Record
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSocioForm" onsubmit="saveSocioRecord(event)">
                <div class="modal-body p-4 small">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Student ID</label>
                        <input type="text" class="form-control form-control-sm" id="modalStudentId" placeholder="e.g. 26S0100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="modalStudentName" placeholder="e.g. Santos, Juan P." required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark">Household Size</label>
                            <input type="number" class="form-control form-control-sm" id="modalHouseholdSize" min="1" value="4" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark">Financial Category</label>
                            <select class="form-select form-select-sm" id="modalCategory" required>
                                <option value="Low income">Low income</option>
                                <option value="Moderate income">Moderate income</option>
                                <option value="High income">High income</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Primary Income Source</label>
                        <input type="text" class="form-control form-control-sm" id="modalIncomeSource" placeholder="e.g. Farming / Employment" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Living Arrangement</label>
                        <select class="form-select form-select-sm" id="modalLiving" required>
                            <option value="With family">With family</option>
                            <option value="Boarding house">Boarding house</option>
                            <option value="Relative's house">Relative's house</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
    function applySocioFilters() {
        const searchInput = document.getElementById('socioSearch').value.toLowerCase().trim();
        const categoryFilter = document.getElementById('financialFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('.socio-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const category = row.getAttribute('data-category');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || name.includes(searchInput);
            const matchesCategory = !categoryFilter || category === categoryFilter;
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noSocioRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }
    }

    function openAddBackgroundModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('addSocioModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Add Record Modal: Connect a backend form to handle new records.');
        }
    }

    function saveSocioRecord(e) {
        e.preventDefault();
        
        const id = document.getElementById('modalStudentId').value.trim();
        const name = document.getElementById('modalStudentName').value.trim();
        const size = document.getElementById('modalHouseholdSize').value;
        const category = document.getElementById('modalCategory').value;
        const source = document.getElementById('modalIncomeSource').value.trim();
        const living = document.getElementById('modalLiving').value;

        // Dynamically insert new row into the table
        const tbody = document.getElementById('socioTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'socio-row';
        newTr.setAttribute('data-id', id.toLowerCase());
        newTr.setAttribute('data-name', name.toLowerCase());
        newTr.setAttribute('data-category', category);
        newTr.setAttribute('data-status', 'For review');

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary">${id}</td>
            <td class="fw-semibold text-dark truncate-cell">${name}</td>
            <td class="text-center fw-semibold text-dark">${size}</td>
            <td class="text-muted truncate-cell">${source}</td>
            <td><span class="badge-category">${category}</span></td>
            <td class="text-muted">${living}</td>
            <td class="text-center pe-3"><span class="status-badge-review">For review</span></td>
        `;

        // Insert at top of body before fallback row
        tbody.insertBefore(newTr, tbody.firstChild);

        // Hide modal
        const modalElem = document.getElementById('addSocioModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();

        // Reset form
        document.getElementById('addSocioForm').reset();

        // Re-apply filters
        applySocioFilters();
    }
</script>