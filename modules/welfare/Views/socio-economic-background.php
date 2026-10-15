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

        /* Search Pill Input Styling */
        .search-pill-wrapper {
            background-color: #fcfcfd;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 4px 16px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
        }

        .search-pill-wrapper:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.15rem rgba(88, 17, 26, 0.15);
            background-color: #ffffff;
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 0.875rem;
            color: #495057;
            width: 100%;
        }

        /* Filter Selects */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            max-width: 160px;
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
            padding: 6px 16px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .btn-maroon-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }

        .btn-view-maroon {
            color: #58111a !important;
            border: 1.5px solid #58111a !important;
            background-color: #ffffff !important;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-view-maroon:hover {
            color: #ffffff !important;
            background-color: #58111a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fcfcfd;
        }
    </style>

    <!-- Breadcrumb & Header Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-house me-1"></i> Home
            </a>
            <span class="text-muted">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted">/</span>
            <span class="small fw-bold marsu-maroon-text">SOCIO-ECONOMIC BACKGROUND</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h4 class="fw-bold marsu-maroon-text mb-1">Socio-economic Background</h4>
        <p class="text-muted small mb-0">Record and review students' household, financial, and living circumstances to help identify appropriate institutional support.</p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
            
            <!-- Pill Search Bar -->
            <div class="search-pill-wrapper" style="width: 320px;">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="search" id="socioSearch" class="search-pill-input" placeholder="Search student name or ID..." oninput="filterTable('socioSearch','socioTable')" autocomplete="off">
            </div>

            <!-- Toolbar Actions & Filters -->
            <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap">Category:</label>
                    <select class="form-select form-select-sm filter-select" id="financialFilter">
                        <option value="">All Categories</option>
                        <option value="Low income">Low income</option>
                        <option value="Moderate income">Moderate income</option>
                        <option value="High income">High income</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-1">
                    <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">Status:</label>
                    <select class="form-select form-select-sm filter-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="For review">For review</option>
                        <option value="Reviewed">Reviewed</option>
                    </select>
                </div>

                <button type="button" class="btn btn-maroon-primary ms-1" onclick="showToast('Demo only: connect a form to save new socio-economic details.')">
                    <i class="bi bi-plus-circle me-1"></i> Add Background Record
                </button>
            </div>
        </div>
    </div>

    <!-- Socio-Economic Master Directory Table -->
   <div class="table-responsive bg-white rounded border shadow-sm mb-4">
    <table class="table table-hover align-middle mb-0 fixed-table" id="socioTable">
        <thead class="table-light text-uppercase small text-muted">
    <tr>
        <th class="ps-3 py-3" style="width: 12%; white-space: normal !important; vertical-align: middle;">Student ID</th>
        <th class="py-3" style="width: 15%; white-space: normal !important; vertical-align: middle;">Student Name</th>
        <th class="py-3" style="width: 10%; white-space: normal !important; vertical-align: middle;">Household Size</th>
        <th class="py-3" style="width: 22%; white-space: normal !important; vertical-align: middle;">Primary Income Source</th>
        <th class="py-3" style="width: 15%; white-space: normal !important; vertical-align: middle;">Financial Category</th>
        <th class="py-3" style="width: 13%; white-space: normal !important; vertical-align: middle;">Living Arrangement</th>
        <th class="py-3 text-center pe-3" style="width: 10%; white-space: normal !important; vertical-align: middle;">Review Status</th>
    </tr>
      </thead>
        <tbody class="small">
            <tr>
                <td class="ps-3 fw-semibold text-secondary">26S0041</td>
                <td class="fw-semibold text-dark truncate-cell">Adamos, Mariedhen L.</td>
                <td class="text-center fw-semibold text-dark">5</td>
                <td class="text-muted truncate-cell">Parent/guardian employment</td>
                <td><span class="badge-category">Low income</span></td>
                <td class="text-muted">With family</td>
                <td class="text-center pe-3"><span class="status-badge-review">For review</span></td>
            </tr>
            <tr>
                    <td class="ps-3 fw-semibold text-secondary">26S0087</td>
                    <td class="fw-semibold text-dark truncate-cell">Ali, Kyla Diane M.</td>
                    <td class="text-center fw-semibold text-dark">4</td>
                    <td class="text-muted truncate-cell">Small business</td>
                    <td>
                        <span class="badge-category">Moderate income</span>
                    </td>
                    <td class="text-muted">With family</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-reviewed">Reviewed</span>
                    </td>
                </tr>
                 <tr>
                    <td class="ps-3 fw-semibold text-secondary">26S0095</td>
                    <td class="fw-semibold text-dark truncate-cell">Almonte, Hanz Andrei R.</td>
                    <td class="text-center fw-semibold text-dark">6</td>
                    <td class="text-muted truncate-cell">Daily wage</td>
                    <td>
                        <span class="badge-category">Low income</span>
                    </td>
                    <td class="text-muted">Boarding house</td>
                    <td class="text-center pe-3">
                        <span class="status-badge-review">For review</span>
                    </td>
                </tr>
            <!-- Iba pang rows... -->
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