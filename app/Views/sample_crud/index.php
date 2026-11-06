<div class="container-fluid px-0">

    <!-- PAGE HEADER -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-marsu text-white px-2 py-1 small">Admin Reference</span>
                <span class="badge badge-gold px-2 py-1 small">2-Field Example</span>
            </div>
            <h4 class="fw-bold text-marsu-burgundy mb-1 mt-2">
                <i class="bi bi-journal-code me-2"></i>CRUD Demo & Reference Guide
            </h4>
            <p class="text-muted small mb-0">
                Halimbawa para sa mga student module developers kung paano gamitin ang handwritten Core helpers:
                <code>Database::insert()</code>, <code>Database::fetchAll()</code>, <code>Database::update()</code>, at <code>csrf_field()</code>.
            </p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= url('dashboard') ?>" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>Bumalik sa Dashboard
            </a>
        </div>
    </div>

    <!-- MAIN INTERACTIVE ROW -->
    <div class="row g-4">

        <!-- LEFT COLUMN: CREATE FORM (HAKBANG 1: INSERT) -->
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="mb-0 fw-bold text-marsu-burgundy">
                        <i class="bi bi-plus-circle-fill me-2 text-gold"></i>1. CREATE (Mag-insert ng Bagong Record)
                    </h6>
                    <small class="text-muted" style="font-size: 0.78rem;">
                        Punan ang 2 fields sa ibaba upang makita kung paano gumagana ang pag-insert sa database (<code>sample_items</code>).
                    </small>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= url('sample-crud/create') ?>">
                        <!-- MANDATORY: Core CSRF Protection -->
                        <?= csrf_field() ?>

                        <!-- Field 1: Title -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">
                                Field 1: Item Title <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Halimbawa: Projector Cable" required autocomplete="off">
                            </div>
                            <div class="form-text small text-muted">Pangalan o pamagat ng item na gustong i-save.</div>
                        </div>

                        <!-- Field 2: Category -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">
                                Field 2: Category <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-tag-fill"></i></span>
                                <select name="category" class="form-select" required>
                                    <option value="" disabled selected>-- Pumili ng Category --</option>
                                    <option value="Academic">Academic</option>
                                    <option value="Equipment">Equipment</option>
                                    <option value="Administrative">Administrative</option>
                                    <option value="Facilities">Facilities</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-text small text-muted">Kategorya kung saan nabibilang ang item.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">
                                Purpose <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                                <input type="text" name="purpose" class="form-control"
                                    placeholder="Halimbawa: Projector Cable" required autocomplete="off">
                            </div>
                            <div class="form-text small text-muted">Pangalan o pamagat ng item na gustong i-save.</div>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-marsu w-100 py-2 shadow-sm">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i>Save Item to Database (Insert)
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-light py-2 px-4 border-top">
                    <small class="text-muted font-monospace" style="font-size: 0.75rem;">
                        <i class="bi bi-code-slash me-1"></i>Core Helper:
                        <code>Database::insert('sample_items', [...])</code>
                    </small>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: RECORDS TABLE (HAKBANG 2 & 3: VIEW AT UPDATE) -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-marsu-burgundy">
                        <i class="bi bi-table me-2 text-gold"></i>2. VIEW (Listahan mula sa Database)
                    </h6>
                    <span class="badge badge-burgundy"><?= count($items) ?> Active Records</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-marsu">
                            <tr>
                                <th class="ps-3" style="width: 60px;">ID</th>
                                <th>Title (Field 1)</th>
                                <th>Category (Field 2)</th>
                                <th>Purpose</th>
                                <th>Date Added</th>
                                <th class="text-end pe-3" style="width: 130px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (empty($items)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2 text-muted opacity-50"></i>
                                        Walang laman ang table. Subukan mag-insert gamit ang form sa kaliwa!
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td class="ps-3 text-muted fw-bold">#<?= e($item['id']) ?></td>
                                        <td>
                                            <strong class="text-marsu-burgundy fs-6"><?= e($item['title']) ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-gold font-monospace"><?= e($item['category']) ?></span>
                                        </td>

                                        <td>
                                            <?= e($item['purpose']) ?>
                                        </td>
                                        <td class="text-muted small">
                                            <?= e(date('M d, Y h:i A', strtotime($item['created_at']))) ?>
                                        </td>
                                        <td class="text-end pe-3">
                                            <!-- UPDATE BUTTON (Opens Modal) -->
                                            <button type="button" class="btn btn-sm btn-outline-marsu me-1"
                                                onclick='openEditModal(<?= json_encode($item) ?>)' title="Edit / Update Item">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            <!-- DELETE / ARCHIVE BUTTON -->
                                            <form method="POST" action="<?= url('sample-crud/delete') ?>" class="d-inline"
                                                onsubmit="return confirm('Sigurado ka bang nais mong i-delete/i-archive ang item na ito?');">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Delete / Archive Item">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light py-2 px-4 border-top">
                    <small class="text-muted font-monospace" style="font-size: 0.75rem;">
                        <i class="bi bi-code-slash me-1"></i>Core Helper:
                        <code>Database::fetchAll("SELECT * FROM sample_items WHERE deleted_at IS NULL ...")</code>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION: CODE CHEAT SHEET PARA SA MGA ESTUDYANTE -->
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-marsu text-white py-3 d-flex align-items-center justify-content-between">
            <h6 class="mb-0 fw-bold">
                <i class="bi bi-file-earmark-code-fill me-2 text-gold"></i>Student Cheatsheet: Paano Gumagana ang Bawat Hakbang sa Code
            </h6>
            <span class="badge bg-white text-dark small font-monospace">MarSU Native PHP 8 Architecture</span>
        </div>
        <div class="card-body p-4 bg-light">
            <div class="row g-3">

                <!-- Step 1: INSERT -->
                <div class="col-md-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm p-3 bg-white">
                        <div class="fw-bold text-success mb-2">
                            <i class="bi bi-plus-square-fill me-1"></i>1. INSERT (Create)
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                            Sa inyong Controller (hal. <code>store()</code>), gamitin ang <code>Database::insert()</code>. Hindi na kailangan ng manual SQL string!
                        </p>
                        <pre class="bg-dark text-white p-3 rounded small font-monospace mb-2" style="font-size: 0.73rem;"><code>Database::insert('sample_items', [
    'title'      => $title,
    'category'   => $category,
    'created_at' => date('Y-m-d H:i:s')
]);</code></pre>
                        <small class="text-muted" style="font-size: 0.72rem;">
                            <i class="bi bi-shield-check text-success me-1"></i>Awtomatikong naka-prepared statement.
                        </small>
                    </div>
                </div>

                <!-- Step 2: FETCH ALL -->
                <div class="col-md-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm p-3 bg-white">
                        <div class="fw-bold text-primary mb-2">
                            <i class="bi bi-eye-fill me-1"></i>2. FETCH (View / List)
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                            Sa inyong Controller (hal. <code>index()</code>), kunin ang mga records para ipadala sa View via <code>View::render()</code>.
                        </p>
                        <pre class="bg-dark text-white p-3 rounded small font-monospace mb-2" style="font-size: 0.73rem;"><code>$items = Database::fetchAll(
    "SELECT * FROM sample_items 
     WHERE deleted_at IS NULL 
     ORDER BY id DESC"
);</code></pre>
                        <small class="text-muted" style="font-size: 0.72rem;">
                            <i class="bi bi-filter text-primary me-1"></i>Isinasama ang <code>deleted_at IS NULL</code>.
                        </small>
                    </div>
                </div>

                <!-- Step 3: UPDATE -->
                <div class="col-md-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm p-3 bg-white">
                        <div class="fw-bold text-warning mb-2">
                            <i class="bi bi-pencil-square me-1"></i>3. UPDATE (Edit)
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                            Gamitin ang <code>Database::update()</code> na may where clause at parameters para ligtas sa SQL Injection.
                        </p>
                        <pre class="bg-dark text-white p-3 rounded small font-monospace mb-2" style="font-size: 0.73rem;"><code>Database::update('sample_items', [
    'title'      => $title,
    'category'   => $category,
    'updated_at' => date('Y-m-d H:i:s')
], 'id = :id', ['id' => $id]);</code></pre>
                        <small class="text-muted" style="font-size: 0.72rem;">
                            <i class="bi bi-key-fill text-warning me-1"></i>Parameter binding para sa <code>:id</code>.
                        </small>
                    </div>
                </div>

                <!-- Step 4: DELETE / ARCHIVE -->
                <div class="col-md-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm p-3 bg-white">
                        <div class="fw-bold text-danger mb-2">
                            <i class="bi bi-archive-fill me-1"></i>4. ARCHIVE (Soft-Delete)
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                            Sa MarSU ERP standards, hindi nagha-hard delete. Nilalagyan lamang ng timestamp ang <code>deleted_at</code>.
                        </p>
                        <pre class="bg-dark text-white p-3 rounded small font-monospace mb-2" style="font-size: 0.73rem;"><code>Database::update('sample_items', [
    'deleted_at' => date('Y-m-d H:i:s')
], 'id = :id', ['id' => $id]);</code></pre>
                        <small class="text-muted" style="font-size: 0.72rem;">
                            <i class="bi bi-clock-history text-danger me-1"></i>Naiingatan ang audit history.
                        </small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ============================================================================== -->
<!-- EDIT / UPDATE MODAL (Bootstrap 5.3 Native, Zero jQuery)                        -->
<!-- ============================================================================== -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title fs-6 fw-bold" id="editItemModalLabel">
                    <i class="bi bi-pencil-square me-2 text-gold"></i>3. UPDATE (I-edit ang Record)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- FORM PARA SA UPDATE -->
            <form method="POST" action="<?= url('sample-crud/update') ?>">
                <!-- MANDATORY: CSRF Token -->
                <?= csrf_field() ?>

                <div class="modal-body p-4">
                    <!-- Hidden ID input para malaman kung anong row ang papalitan -->
                    <input type="hidden" name="id" id="edit_id">

                    <div class="alert alert-info py-2 px-3 small border-0 mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Binabago ang <strong>Item ID #<span id="edit_id_display" class="fw-bold"></span></strong>
                    </div>

                    <!-- Field 1: Title -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Field 1: Item Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required autocomplete="off">
                    </div>

                    <!-- Field 2: Category -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Field 2: Category</label>
                        <select name="category" id="edit_category" class="form-select" required>
                            <option value="Academic">Academic</option>
                            <option value="Equipment">Equipment</option>
                            <option value="Administrative">Administrative</option>
                            <option value="Facilities">Facilities</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-check-circle-fill me-1"></i>Save Changes (Update)
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JAVASCRIPT: Maglagay ng values sa Edit Modal (Vanilla JS, Zero jQuery) -->
<script>
    function openEditModal(item) {
        document.getElementById('edit_id').value = item.id;
        document.getElementById('edit_id_display').innerText = item.id;
        document.getElementById('edit_title').value = item.title;
        document.getElementById('edit_category').value = item.category;

        const modal = new bootstrap.Modal(document.getElementById('editItemModal'));
        modal.show();
    }
</script>