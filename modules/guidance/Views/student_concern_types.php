<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: STUDENT CONCERN TYPES MAINTENANCE    -->
<!-- ==================================================================== -->

<style>
    .btn-marsu {
        background-color: #800020;
        border-color: #800020;
        color: #ffffff;
    }
    .btn-marsu:hover {
        background-color: #660019;
        border-color: #660019;
        color: #ffffff;
    }
</style>

<!-- 1. BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb mb-0" style="font-size: 14px; background: transparent; padding: 0;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <span class="text-muted">Maintenance</span>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Student Concern Types
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Student Concern Types
            </h4>
            <p class="text-muted mb-0" style="font-size: 14.5px;">
                Standardized student concern type classifications for guidance cases and counseling services.
            </p>
        </div>
        <div>
            <button type="button" class="btn btn-marsu px-3 shadow-none d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#modal-add-concern-type"
                style="font-size: 14px; font-weight: 500; border-radius: 6px; height: 38px;">
                <i class="bi bi-plus-lg me-1.5"></i>Add Concern Type
            </button>
        </div>
    </div>
</div>

<!-- 2. SEARCH BAR -->
<div class="card shadow-sm border-0 mb-3" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-9 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white ps-3" style="border-color: #ced4da; font-size: 14px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="concernSearchInput" class="form-control border-start-0 shadow-none ps-2"
                        placeholder="Search concern type name..."
                        oninput="filterConcernTypes()"
                        style="font-size: 14px; height: 38px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-md-3 col-12 text-md-end text-start">
                <button type="button" onclick="resetConcernSearch()" class="btn w-100 shadow-none d-flex align-items-center justify-content-center"
                    style="border: 1px solid #ced4da; background-color: #f8f9fa; color: #495057; font-size: 13.5px; height: 38px; font-weight: 500; border-radius: 6px;">
                    <i class="bi bi-arrow-counterclockwise me-1.5"></i>Reset Search
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 3. CONCERN TYPES TABLE (CONCERN TYPE NAME & EDIT ACTION ONLY) -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-3 px-md-4" style="border-bottom: 1px solid #E2E8F0 !important;">
        <h6 class="m-0 fw-bold" style="font-size: 15px; color: #800020;">
            <i class="bi bi-card-checklist me-2" style="color: #D4AF37;"></i>Concern Types List
        </h6>
        <span id="concernRecordCount" class="badge" style="background-color: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600;">
            Showing 8 Records
        </span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="concernTypesTable">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-4" style="font-size: 13.5px; font-weight: 600; padding: 14px 16px; width: 80px; color: #2D3748;">
                            #
                        </th>
                        <th style="font-size: 13.5px; font-weight: 600; padding: 14px 16px; color: #2D3748;">
                            Concern Type Name
                        </th>
                        <th class="text-center pe-4" style="font-size: 13.5px; font-weight: 600; padding: 14px 16px; width: 100px; color: #2D3748;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="concernTypesTableBody" style="font-size: 14.5px;">
                    <!-- Populated dynamically via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Empty state when searching -->
        <div id="noResultsRow" class="text-center py-5 d-none">
            <i class="bi bi-folder-x fs-1 text-muted d-block mb-2"></i>
            <h6 class="fw-semibold text-secondary mb-1">No concern types found</h6>
            <p class="text-muted small mb-0">Try searching with a different keyword.</p>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: ADD CONCERN TYPE                                           -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-add-concern-type" tabindex="-1" aria-labelledby="modalAddConcernLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" id="modalAddConcernLabel" style="font-size: 16px;">
                        Add Concern Type
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddConcern" onsubmit="event.preventDefault(); saveNewConcernType();">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold mb-1" style="font-size: 14px;">
                            Concern Type Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="addConcernName" class="form-control shadow-none"
                            placeholder="Enter concern type name (e.g. Grief and Loss Counseling)..."
                            required style="font-size: 14px; height: 42px;">
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 36px; border-radius: 6px;">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu px-3 shadow-none" style="height: 36px; border-radius: 6px;">
                        <i class="bi bi-check-lg me-1"></i>Save Concern Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: EDIT CONCERN TYPE (CONCERN TYPE NAME ONLY)                 -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-edit-concern-type" tabindex="-1" aria-labelledby="modalEditConcernLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" id="modalEditConcernLabel" style="font-size: 16px;">
                        Edit Concern Type Name
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditConcern" onsubmit="event.preventDefault(); updateConcernType();">
                <?= csrf_field() ?>
                <input type="hidden" id="editConcernId" value="">
                <div class="modal-body p-4" style="background-color: #F8FAFC;">
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold mb-1" style="font-size: 14px;">
                            Concern Type Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="editConcernName" class="form-control shadow-none"
                            placeholder="Enter updated concern type name..."
                            required style="font-size: 14px; height: 42px;">
                        <span class="small text-muted mt-1 d-block" style="font-size: 12px;">
                            Baguhin ang concern type name kung may pagkakamali sa pag-input.
                        </span>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="height: 36px; border-radius: 6px;">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu px-3 shadow-none" style="height: 36px; border-radius: 6px;">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   VANILLA JAVASCRIPT: FILTERING & EDITING LOGIC                      -->
<!-- ==================================================================== -->
<script>
    // Master Concern Types List
    let concernTypesList = [
        { id: 1, name: 'Academic Performance & Probation' },
        { id: 2, name: 'Mental Health & Emotional Well-being' },
        { id: 3, name: 'Career Guidance & Placement' },
        { id: 4, name: 'Interpersonal & Peer Relationship' },
        { id: 5, name: 'Financial Distress & Socio-Economic' },
        { id: 6, name: 'Behavioral & Disciplinary Concerns' },
        { id: 7, name: 'Family & Domestic Adjustment' },
        { id: 8, name: 'Legacy Routine General Inquiry' }
    ];

    let editModal = null;
    let addModal = null;

    document.addEventListener('DOMContentLoaded', function () {
        editModal = new bootstrap.Modal(document.getElementById('modal-edit-concern-type'));
        addModal = new bootstrap.Modal(document.getElementById('modal-add-concern-type'));
        renderConcernTypesTable(concernTypesList);
    });

    /**
     * Render Concern Types Table
     * Displays Concern Type Name only and Edit Action button (icon only, no text)
     */
    function renderConcernTypesTable(list) {
        const tbody = document.getElementById('concernTypesTableBody');
        const badge = document.getElementById('concernRecordCount');
        const noResults = document.getElementById('noResultsRow');

        if (badge) badge.textContent = `Showing ${list.length} of ${concernTypesList.length} Records`;

        if (!tbody) return;
        tbody.innerHTML = '';

        if (!list.length) {
            noResults.classList.remove('d-none');
            return;
        } else {
            noResults.classList.add('d-none');
        }

        list.forEach((item, index) => {
            const tr = document.createElement('tr');
            tr.className = 'align-middle';

            tr.innerHTML = `
                <td class="ps-4 text-muted fw-semibold" style="padding: 14px 16px; width: 80px;">
                    ${index + 1}
                </td>
                <td style="padding: 14px 16px;">
                    <span class="fw-semibold text-dark fs-6">${item.name}</span>
                </td>
                <td class="text-center pe-4" style="padding: 14px 16px; width: 100px;">
                    <button type="button" class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                        onclick="openEditModal(${item.id})"
                        title="Edit Concern Type Name"
                        aria-label="Edit Concern Type Name"
                        style="width: 34px; height: 34px; border-radius: 6px; border: 1px solid #D4AF37; color: #856404; background-color: #FFFDF0; padding: 0;">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    /**
     * Search / Filter Table
     */
    function filterConcernTypes() {
        const query = (document.getElementById('concernSearchInput').value || '').toLowerCase().trim();
        const filtered = concernTypesList.filter(item => item.name.toLowerCase().includes(query));
        renderConcernTypesTable(filtered);
    }

    /**
     * Reset Search
     */
    function resetConcernSearch() {
        document.getElementById('concernSearchInput').value = '';
        renderConcernTypesTable(concernTypesList);
    }

    /**
     * Open Edit Modal
     */
    function openEditModal(id) {
        const item = concernTypesList.find(c => c.id === id);
        if (!item) return;

        document.getElementById('editConcernId').value = item.id;
        document.getElementById('editConcernName').value = item.name;
        editModal.show();
    }

    /**
     * Update Concern Type Name
     */
    function updateConcernType() {
        const id = parseInt(document.getElementById('editConcernId').value);
        const newName = document.getElementById('editConcernName').value.trim();

        if (!newName) {
            alert('Pakilagay ang Concern Type Name.');
            return;
        }

        const item = concernTypesList.find(c => c.id === id);
        if (item) {
            item.name = newName;
            filterConcernTypes();
            editModal.hide();
        }
    }

    /**
     * Save New Concern Type Name
     */
    function saveNewConcernType() {
        const newName = document.getElementById('addConcernName').value.trim();
        if (!newName) {
            alert('Pakilagay ang Concern Type Name.');
            return;
        }

        const newId = concernTypesList.length > 0 ? Math.max(...concernTypesList.map(c => c.id)) + 1 : 1;
        concernTypesList.push({ id: newId, name: newName });

        document.getElementById('formAddConcern').reset();
        filterConcernTypes();
        addModal.hide();
    }
</script>