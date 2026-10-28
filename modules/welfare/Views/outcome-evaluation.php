<!-- Outcome Evaluation Management (MarSU OSAS Standard) -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        /* Responsive Table Container with Touch Scroll */
        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.75rem;
            border: 1px solid #dee2e6;
        }

        /* Flexible Uncompressed Table Layout */
        .uncompressed-table {
            width: 100% !important;
            min-width: 1100px;
            border-collapse: collapse !important;
        }

        .uncompressed-table td, 
        .uncompressed-table th {
            vertical-align: middle !important;
            padding: 12px 16px !important;
            border-bottom: 1px solid #dee2e6 !important;
            white-space: nowrap;
        }

        .uncompressed-table td.truncate-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Search Pill Input Styling */
        .search-pill-wrapper-short {
            background-color: #ffffff;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 6px 14px;
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

        /* Filter Selects */
        .filter-select {
            width: auto !important;
            min-width: 140px;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 8px !important;
        }

        /* Status / Recommendation Badges */
        .status-badge-effective {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #d4edda !important;
            color: #0f5132 !important;
            border: 1px solid #198754 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-monitoring {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #cff4fc !important;
            color: #055160 !important;
            border: 1px solid #b6effb !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-verifying {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        .status-badge-pending {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            padding: 5px 12px !important;
            border-radius: 50rem !important;
            background-color: #e2e3e5 !important;
            color: #41464b !important;
            border: 1px solid #ced4da !important;
            display: inline-flex !important;
            align-items: center;
            white-space: nowrap !important;
        }

        /* Buttons */
        .btn-maroon-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 7px 16px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
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
            font-size: 0.825rem;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn-view-maroon:hover {
            color: #ffffff !important;
            background-color: #58111a !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fafbfc;
        }

        .icon-shrink-0 {
            flex-shrink: 0 !important;
        }

        /* Essential Details View Modal Styling */
        .essential-info-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .essential-label {
            font-size: 0.72rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .essential-value {
            font-size: 0.9rem;
            color: #0f172a;
            font-weight: 600;
        }

        /* Compact Stepper UI */
        .compact-stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            padding: 10px 0 4px 0;
        }

        .compact-step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        .compact-step-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.78rem;
            margin-bottom: 4px;
        }

        .compact-step-circle.completed {
            background-color: #10b981;
            color: #fff;
        }

        .compact-step-circle.active {
            background-color: #58111a;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(88, 17, 26, 0.15);
        }

        .compact-step-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: #64748b;
        }

        .compact-step-line {
            position: absolute;
            top: 24px;
            left: 10%;
            right: 10%;
            height: 2px;
            background-color: #e2e8f0;
            z-index: 1;
        }
    </style>

    <!-- Breadcrumb Navigation Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center px-3 py-1.5">
                <i class="bi bi-house me-1.5 icon-shrink-0"></i> Home
            </a>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT AFFAIRS (OSAS)</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">INTERVENTION MONITORING</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">OUTCOME EVALUATION</span>
        </div>
    </div>

    <!-- Page Title & Overview Section -->
    <div class="mb-4 pb-1">
        <h3 class="fw-bold marsu-maroon-text mb-2">Outcome Evaluation</h3>
        <p class="text-muted small mb-0 lh-base" style="max-width: 800px;">
            Assess whether interventions addressed the original student concern, review empirical feedback, and identify any continuing support needs for ongoing student welfare cases.
        </p>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-nowrap gap-2.5 align-items-center justify-content-between overflow-x-auto">
            
            <!-- 1. Search Bar -->
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2 icon-shrink-0"></i>
                <input type="search" id="outcomeSearch" class="search-pill-input" placeholder="Search case or student..." oninput="applyOutcomeFilters()" autocomplete="off">
            </div>

            <!-- 2. Recommendation Status Filter -->
            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                <label class="small fw-semibold text-muted mb-0 text-nowrap">Result / Status:</label>
                <select class="form-select form-select-sm filter-select" id="outcomeStatusFilter" onchange="applyOutcomeFilters()">
                    <option value="">All Results</option>
                    <option value="Effective">Effective</option>
                    <option value="Monitoring">Monitoring</option>
                    <option value="Verifying">Verifying</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <!-- 3. Add Evaluation Button -->
            <button type="button" class="btn btn-maroon-primary d-inline-flex align-items-center gap-1 flex-shrink-0" onclick="openNewOutcomeModal()">
                <i class="bi bi-plus-circle me-1 icon-shrink-0"></i> Add Evaluation
            </button>

        </div>
    </div>

    <!-- Outcome Evaluation Table -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0 uncompressed-table" id="outcomeTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 13%;">Evaluation ID</th>
                    <th class="py-3" style="width: 13%;">Case No.</th>
                    <th class="py-3" style="width: 18%;">Student Name</th>
                    <th class="py-3" style="width: 22%;">Intervention</th>
                    <th class="py-3 text-center" style="width: 13%;">Evaluation Date</th>
                    <th class="py-3 text-center" style="width: 12%;">Recommendations</th>
                    <th class="py-3 text-center pe-3" style="width: 9%;">Action</th>
                </tr>
            </thead>
            <tbody class="small" id="outcomeTableBody">
                <tr class="outcome-row" id="row-oe-2026-010" data-id="oe-2026-010" data-case="cm-2026-0245" data-student="santos, paolo r." data-status="Monitoring">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">OE-2026-010</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0245</td>
                    <td class="fw-semibold text-dark truncate-cell">Santos, Paolo R.</td>
                    <td class="text-muted truncate-cell">Family Consultation & Support</td>
                    <td class="text-center text-muted text-nowrap">Oct 10, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-monitoring">Monitoring</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialOutcomeModal('OE-2026-010', 'CM-2026-0245', 'Santos, Paolo R.', 'Family Consultation & Support', 'Oct 10, 2026', 'Monitoring', 'Family dialogue conducted; bi-weekly check-ins recommended.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="outcome-row" id="row-oe-2026-009" data-id="oe-2026-009" data-case="cm-2026-0247" data-student="reyes, maricel s." data-status="Verifying">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">OE-2026-009</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0247</td>
                    <td class="fw-semibold text-dark truncate-cell">Reyes, Maricel S.</td>
                    <td class="text-muted truncate-cell">Financial Assistance Facilitation</td>
                    <td class="text-center text-muted text-nowrap">Oct 08, 2026</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-verifying">Verifying</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialOutcomeModal('OE-2026-009', 'CM-2026-0247', 'Reyes, Maricel S.', 'Financial Assistance Facilitation', 'Oct 08, 2026', 'Verifying', 'Disbursement document submission under review by cashier unit.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
                <tr class="outcome-row" id="row-oe-2026-008" data-id="oe-2026-008" data-case="cm-2026-0248" data-student="dela cruz, angelo m." data-status="Pending">
                    <td class="ps-3 fw-semibold text-secondary text-nowrap">OE-2026-008</td>
                    <td class="fw-semibold text-dark text-nowrap">CM-2026-0248</td>
                    <td class="fw-semibold text-dark truncate-cell">Dela Cruz, Angelo M.</td>
                    <td class="text-muted truncate-cell">Academic Coaching & Tutoring</td>
                    <td class="text-center text-muted text-nowrap">—</td>
                    <td class="text-center status-cell">
                        <span class="status-badge-pending">Pending</span>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialOutcomeModal('OE-2026-008', 'CM-2026-0248', 'Dela Cruz, Angelo M.', 'Academic Coaching & Tutoring', '—', 'Pending', 'Awaiting prelim examination grades for performance evaluation.')">
                            <i class="bi bi-eye me-1"></i> View
                        </button>
                    </td>
                </tr>

                <!-- Fallback Empty Row -->
                <tr id="noOutcomeRecordsRow" style="display: none;">
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fw-semibold">No evaluation records found</p>
                        <small>No records matched your search query or selected filters.</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination / Summary Footer -->
    <div class="d-flex justify-content-between align-items-center text-muted small px-1 mb-4">
        <span id="showingText">Showing 3 of 3 evaluation records</span>
        <span>Page 1 of 1</span>
    </div>

    <!-- Evaluation Checklist Banner -->
    <div class="card border-0 bg-light rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-start gap-3.5">
            <div class="p-2 bg-white rounded-circle shadow-sm icon-shrink-0">
                <i class="bi bi-clipboard-data-fill marsu-maroon-text fs-3"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1.5">MarSU OSAS Evaluation Protocol</h6>
                <p class="text-muted small mb-0 lh-base" style="max-width: 950px;">
                    Compare the outcome with initial support goals, review student feedback and academic performance evidence, record remaining needs, and determine whether to continue, adjust, refer, or close the case. All evaluation records must remain objective and strictly confidential.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================================== -->
<!-- MODAL 1: ESSENTIAL DETAILS ONLY VIEW (OUTCOME EVALUATION FOCUS)        -->
<!-- ===================================================================== -->
<div class="modal fade" id="essentialOutcomeModal" tabindex="-1" aria-labelledby="essentialOutcomeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header marsu-maroon-bg text-white py-3 px-4">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">EVALUATION RESULT DETAILS</span>
                    <h5 class="modal-title fw-bold mb-0" id="vEvalId">OE-2026-010</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light-subtle">
                
                <input type="hidden" id="activeEvalId" value="">

                <!-- 1. Student / Case Reference Card -->
                <div class="essential-info-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="essential-label">Student / Case Reference</span>
                        <span class="status-badge-monitoring" id="vStatusBadge">Monitoring</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="vStudentName">Santos, Paolo R.</h5>
                    <div class="small text-muted fw-semibold" id="vCaseNo">Case No: CM-2026-0245</div>
                </div>

                <!-- 2. Evaluation Highlights Grid -->
                <div class="row g-2 mb-3">
                    <div class="col-7">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Intervention Rendered</div>
                            <div class="essential-value marsu-maroon-text" id="vIntervention">Family Consultation & Support</div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="essential-info-card h-100">
                            <div class="essential-label">Evaluation Date</div>
                            <div class="essential-value text-dark" id="vEvalDate">Oct 10, 2026</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Stage Tracker -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-2">Evaluation Workflow Stage</div>
                    <div class="compact-stepper">
                        <div class="compact-step-line"></div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle completed" id="oest1"><i class="bi bi-check"></i></div>
                            <span class="compact-step-label">Assessed</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle active" id="oest2">2</div>
                            <span class="compact-step-label text-dark fw-bold">Monitoring</span>
                        </div>
                        <div class="compact-step-item">
                            <div class="compact-step-circle" id="oest3">3</div>
                            <span class="compact-step-label">Resolved</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Notes & Recommendations -->
                <div class="essential-info-card mb-3">
                    <div class="essential-label mb-1">Summary & Next Steps</div>
                    <div class="small text-dark fw-semibold" id="vNotesText">Family dialogue conducted; bi-weekly check-ins recommended.</div>
                </div>

                <!-- 5. Quick Status Update Selector -->
                <div class="border-top pt-3">
                    <label class="form-label essential-label mb-1">Update Recommendation Status</label>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="vStatusSelect">
                            <option value="Effective">Effective</option>
                            <option value="Monitoring">Monitoring</option>
                            <option value="Verifying">Verifying</option>
                            <option value="Pending">Pending</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-maroon-primary flex-shrink-0" onclick="saveEssentialOutcomeStatus()">Save Status</button>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-light py-2 px-4 justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- MODAL 2: ADD NEW OUTCOME EVALUATION                                   -->
<!-- ===================================================================== -->
<div class="modal fade" id="newOutcomeModal" tabindex="-1" aria-labelledby="newOutcomeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="newOutcomeModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Add Outcome Evaluation
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newOutcomeForm" onsubmit="saveNewOutcomeEvaluation(event)">
                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Evaluation ID</label>
                            <input type="text" class="form-control form-control-sm" id="newEvalId" placeholder="e.g. OE-2026-011" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Case Number</label>
                            <input type="text" class="form-control form-control-sm" id="newCaseNo" placeholder="e.g. CM-2026-0249" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Student Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="newStudentName" placeholder="e.g. Santos, Maria A." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Intervention Type</label>
                        <input type="text" class="form-control form-control-sm" id="newIntervention" placeholder="e.g. Academic Counseling & Tutorial" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Evaluation Date</label>
                            <input type="date" class="form-control form-control-sm" id="newEvalDate">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Recommendation Status</label>
                            <select class="form-select form-select-sm" id="newStatus" required>
                                <option value="Effective">Effective</option>
                                <option value="Monitoring">Monitoring</option>
                                <option value="Verifying">Verifying</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Summary & Recommendations</label>
                        <textarea class="form-control form-control-sm" id="newNotes" rows="3" placeholder="Document evaluation results, student feedback, or continuing steps..." required></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-maroon-primary">Save Evaluation</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ===================================================================== -->
<!-- JAVASCRIPT LOGIC                                                      -->
<!-- ===================================================================== -->
<script>
    function applyOutcomeFilters() {
        const searchInput = document.getElementById('outcomeSearch').value.toLowerCase().trim();
        const statusFilter = document.getElementById('outcomeStatusFilter').value;

        const rows = document.querySelectorAll('.outcome-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            const caseNo = row.getAttribute('data-case');
            const student = row.getAttribute('data-student');
            const status = row.getAttribute('data-status');

            const matchesSearch = !searchInput || id.includes(searchInput) || caseNo.includes(searchInput) || student.includes(searchInput);
            const matchesStatus = !statusFilter || status.toLowerCase() === statusFilter.toLowerCase();

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRecordsRow = document.getElementById('noOutcomeRecordsRow');
        if (noRecordsRow) {
            noRecordsRow.style.display = (visibleCount === 0) ? '' : 'none';
        }

        const showingText = document.getElementById('showingText');
        if (showingText) {
            showingText.innerText = `Showing ${visibleCount} of ${rows.length} evaluation records`;
        }
    }

    function openEssentialOutcomeModal(evalId, caseNo, student, intervention, evalDate, status, notes) {
        document.getElementById('activeEvalId').value = evalId.toLowerCase();
        document.getElementById('vEvalId').innerText = evalId;
        document.getElementById('vCaseNo').innerText = 'Case No: ' + caseNo;
        document.getElementById('vStudentName').innerText = student;
        document.getElementById('vIntervention').innerText = intervention;
        document.getElementById('vEvalDate').innerText = evalDate || '—';
        document.getElementById('vNotesText').innerText = notes || '—';

        const badgeElem = document.getElementById('vStatusBadge');
        badgeElem.innerText = status;
        
        const lower = status.toLowerCase();
        if (lower === 'effective') badgeElem.className = 'status-badge-effective';
        else if (lower === 'monitoring') badgeElem.className = 'status-badge-monitoring';
        else if (lower === 'verifying') badgeElem.className = 'status-badge-verifying';
        else badgeElem.className = 'status-badge-pending';

        const statusSelect = document.getElementById('vStatusSelect');
        if (statusSelect) statusSelect.value = status;

        // Stepper Stage UI Update
        const st1 = document.getElementById('oest1');
        const st2 = document.getElementById('oest2');
        const st3 = document.getElementById('oest3');

        st1.className = 'compact-step-circle completed';

        if (lower === 'effective') {
            st2.className = 'compact-step-circle completed';
            st3.className = 'compact-step-circle completed';
            st3.innerHTML = '<i class="bi bi-check"></i>';
        } else if (lower === 'monitoring' || lower === 'verifying') {
            st2.className = 'compact-step-circle active';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        } else {
            st1.className = 'compact-step-circle active';
            st1.innerText = '1';
            st2.className = 'compact-step-circle';
            st2.innerText = '2';
            st3.className = 'compact-step-circle';
            st3.innerText = '3';
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('essentialOutcomeModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('View Evaluation Details: ' + evalId);
        }
    }

    function saveEssentialOutcomeStatus() {
        const activeEvalId = document.getElementById('activeEvalId').value;
        const newStatus = document.getElementById('vStatusSelect').value;

        const targetRow = document.getElementById('row-' + activeEvalId);

        if (targetRow) {
            targetRow.setAttribute('data-status', newStatus);

            let newBadgeClass = 'status-badge-pending';
            const lowerStatus = newStatus.toLowerCase();
            if (lowerStatus === 'effective') newBadgeClass = 'status-badge-effective';
            else if (lowerStatus === 'monitoring') newBadgeClass = 'status-badge-monitoring';
            else if (lowerStatus === 'verifying') newBadgeClass = 'status-badge-verifying';

            const statusCell = targetRow.querySelector('.status-cell');
            if (statusCell) {
                statusCell.innerHTML = `<span class="${newBadgeClass}">${newStatus}</span>`;
            }

            const viewBtn = targetRow.querySelector('.btn-view-maroon');
            if (viewBtn) {
                const idText = targetRow.cells[0].innerText;
                const caseText = targetRow.cells[1].innerText;
                const studentText = targetRow.cells[2].innerText;
                const interventionText = targetRow.cells[3].innerText;
                const dateText = targetRow.cells[4].innerText;
                const notesText = document.getElementById('vNotesText').innerText;

                viewBtn.setAttribute('onclick', `openEssentialOutcomeModal('${idText}', '${caseText}', '${studentText}', '${interventionText}', '${dateText}', '${newStatus}', '${notesText}')`);
            }
        }

        const modalElem = document.getElementById('essentialOutcomeModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getInstance(modalElem);
            if (modalInstance) modalInstance.hide();
        }

        applyOutcomeFilters();
        alert('Outcome recommendation status successfully updated!');
    }

    function openNewOutcomeModal() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modalElem = document.getElementById('newOutcomeModal');
            const modalInstance = new bootstrap.Modal(modalElem);
            modalInstance.show();
        } else {
            alert('Add Outcome Evaluation Form');
        }
    }

    function saveNewOutcomeEvaluation(e) {
        e.preventDefault();

        const evalId = document.getElementById('newEvalId').value.trim();
        const caseNo = document.getElementById('newCaseNo').value.trim();
        const student = document.getElementById('newStudentName').value.trim();
        const intervention = document.getElementById('newIntervention').value.trim();
        const rawDate = document.getElementById('newEvalDate').value;
        const status = document.getElementById('newStatus').value;
        const notes = document.getElementById('newNotes').value.trim();

        let formattedDate = '—';
        if (rawDate) {
            const dateObj = new Date(rawDate);
            formattedDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }

        let badgeClass = 'status-badge-pending';
        const lowerStatus = status.toLowerCase();
        if (lowerStatus === 'effective') badgeClass = 'status-badge-effective';
        else if (lowerStatus === 'monitoring') badgeClass = 'status-badge-monitoring';
        else if (lowerStatus === 'verifying') badgeClass = 'status-badge-verifying';

        const rowId = 'row-' + evalId.toLowerCase();
        const tbody = document.getElementById('outcomeTableBody');
        const newTr = document.createElement('tr');
        newTr.className = 'outcome-row';
        newTr.id = rowId;
        newTr.setAttribute('data-id', evalId.toLowerCase());
        newTr.setAttribute('data-case', caseNo.toLowerCase());
        newTr.setAttribute('data-student', student.toLowerCase());
        newTr.setAttribute('data-status', status);

        newTr.innerHTML = `
            <td class="ps-3 fw-semibold text-secondary text-nowrap">${evalId}</td>
            <td class="fw-semibold text-dark text-nowrap">${caseNo}</td>
            <td class="fw-semibold text-dark truncate-cell">${student}</td>
            <td class="text-muted truncate-cell">${intervention}</td>
            <td class="text-center text-muted text-nowrap">${formattedDate}</td>
            <td class="text-center status-cell"><span class="${badgeClass}">${status}</span></td>
            <td class="text-center pe-3">
                <button type="button" class="btn btn-view-maroon btn-sm" onclick="openEssentialOutcomeModal('${evalId}', '${caseNo}', '${student}', '${intervention}', '${formattedDate}', '${status}', '${notes}')">
                    <i class="bi bi-eye me-1"></i> View
                </button>
            </td>
        `;

        tbody.insertBefore(newTr, tbody.firstChild);

        const modalElem = document.getElementById('newOutcomeModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElem);
        if (modalInstance) modalInstance.hide();
        document.getElementById('newOutcomeForm').reset();

        applyOutcomeFilters();
    }
</script>