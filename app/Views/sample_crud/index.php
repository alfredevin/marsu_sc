<!-- Header & Breadcrumbs -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-code-square me-2 text-gold"></i>CRUD Demo &amp; Reference Guide
        </h1>
        <p class="text-muted small mb-0">
            Halimbawa ng pinakasimpleng 2-field database operations: <strong>Insert</strong>, <strong>View</strong>, at
            <strong>Update</strong> gamit ang native PHP at <code>Core\Database</code>.
        </p>
    </div>
    <div>
        <span class="badge bg-burgundy px-3 py-2 text-white">
            <i class="bi bi-mortarboard-fill me-1 text-gold"></i>Student Reference
        </span>
    </div>
</div>

<!-- Flash Notifications (Success / Error Alert) -->
<?php if (Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= e(Core\Session::flash('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <?= e(Core\Session::flash('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- LEFT COLUMN: INSERT FORM (HAKBANG 1: PAG-INSERT) -->
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-plus-circle-fill me-2 text-gold"></i>1. INSERT (Mag-save ng Bagong Data)
                </h6>
                <span class="badge bg-light text-muted border">2 Fields</span>
            </div>
            <div class="card-body p-4">
                <p class="text-muted small mb-3">
                    Punan ang 2 fields sa ibaba at i-click ang <strong>Save Item</strong> para ma-insert sa MySQL table
                    (<code>sample_items</code>).
                </p>
                <form method="POST" action="<?= url('sample-crud/create') ?>">
                    <?= csrf_field() ?>
                    <!-- Field 1 -->
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
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">
                            Field 2: location <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                            <input type="text" name="location" class="form-control" placeholder="Halimbawa: Library" required autocomplete="off">
                        </div>
                        <div class="form-text small text-muted">Pangalan o pamagat ng item na gustong i-save.</div>
                    </div>
            


                    <!-- Field 2: Location -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">
                            Field 1: location <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                            <input type="text" name="location" class="form-control"
                                placeholder="Halimbawa: Projector Cable" required autocomplete="off">
                        </div>
                        <div class="form-text small text-muted">Pangalan o pamagat ng item na gustong i-save.</div>
                    </div>

                    <!-- Field 3: Category -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">
                            Field 3: Category <span class="text-danger">*</span>
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
                    </div>

                    <!-- Field 3: Location -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">
                            Field 3: Item Location <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                            <input type="text" name="location" class="form-control"
                                placeholder="Halimbawa: Projector Cable" required autocomplete="off">
                        </div>
                        <div class="form-text small text-muted">Pangalan o pamagat ng item na gustong i-save.</div>
                    </div>
<<<<<<< HEAD
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">
                            Field 3: Item Gebder <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                            <input type="text" name="gender" class="form-control"
                                placeholder="Halimbawa: Projector Cable" required autocomplete="off">
                        </div>
                        <div class="form-text small text-muted">Pangalan o pamagat ng item na gustong i-save.</div>
                    </div>
=======
                      <!-- Field 3: Location -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">
                            Field 3: Item Location <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                            <input type="text" name="location" class="form-control" placeholder="Halimbawa: Projector Cable" required autocomplete="off">
                        </div>
                        <div class="form-text small text-muted">Location ng item.</div>
                    </div>

                        <!-- Field 3: Title -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">
                            Field 1: Item Title <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-fonts"></i></span>
                            <input type="text" name="location" class="form-control" placeholder="Halimbawa: Projector Cable" required autocomplete="off">
                        </div>
                        <div class="form-text small text-muted">Pangalan o pamagat ng item na gustong i-save.</div>
                    </div>


>>>>>>> dfbd980ae6f1755eb5738fc7a05e83bcd554dddd
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
                <span class="badge badge-burgundy"><?= count($items) ?> Records</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-marsu">
                        <tr>
                            <th class="ps-3" style="width: 50px;">ID</th>
                            <th>Title (Field 1)</th>
                            <th>Location (Field 3)</th>
                            <th>Location</th>
                            <th>Gender</th>
                            <th>Category (Field 2)</th>
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
                                        <?= e($item['title']) ?>
                                    </td>

                                    <td>
                                        <?= e($item['location']) ?>
                                    </td>
                                    <td>
                                        <?= e($item['gender']) ?>
                                    </td>

                                    <td>
                                       <?= e($item['location']) ?>
                                    </td>
                                    <td>
                                        <strong class="text-marsu-burgundy fs-6"><?= e($item['location']) ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-gold font-monospace"><?= e($item['category']) ?></span>
                                    </td>
                                    <td class="text-muted small">
                                        <?= e(date('M d, Y h:i A', strtotime($item['created_at']))) ?>
                                    </td>
                                    <td class="text-end pe-3">
                                        <!-- UPDATE BUTTON (Opens Modal) -->
                                        <button type="button" class="btn btn-sm btn-outline-marsu me-1"
                                            onclick='openEditModal(<?= json_encode($item) ?>)' title="Edit / Update Item">
                                            <i class="bi bi-pencil-square"></i>
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
                    <code>Database::fetchAll("SELECT * FROM sample_items ...")</code>
                </small>
            </div>
        </div>
    </div>
</div>

<!-- BOTTOM SECTION: CODE CHEAT SHEET PARA SA MGA ESTUDYANTE -->
<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-marsu text-white py-3 d-flex align-items-center justify-content-between">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-file-earmark-code-fill me-2 text-gold"></i>Student Cheatsheet: Paano Gumagana ang Bawat
            Function sa PHP
        </h6>
        <span class="badge bg-secondary bg-opacity-50 text-white">MarSU Native PHP Helper</span>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <!-- 1. INSERT CODE -->
            <div class="col-md-4">
                <div class="border rounded p-3 h-100 bg-light">
                    <h6 class="fw-bold text-marsu-burgundy mb-2">
                        <i class="bi bi-plus-circle text-gold me-1"></i>1. INSERT (Pag-save)
                    </h6>
                    <pre class="bg-dark text-white p-3 rounded small font-monospace mb-2" style="font-size: 0.75rem;"><code>Database::insert('sample_items', [
    'title'      => $_POST['title'],
    'category'   => $_POST['category'],
    'created_at' => date('Y-m-d H:i:s')
]);</code></pre>
                    <p class="small text-muted mb-0">
                        Automatic nang gumagamit ng <strong>prepared statements</strong> kaya protektado laban sa SQL
                        injection.
                    </p>
                </div>
            </div>

            <!-- 2. VIEW / FETCH CODE -->
            <div class="col-md-4">
                <div class="border rounded p-3 h-100 bg-light">
                    <h6 class="fw-bold text-marsu-burgundy mb-2">
                        <i class="bi bi-eye text-gold me-1"></i>2. VIEW (Pag-fetch)
                    </h6>
                    <pre class="bg-dark text-white p-3 rounded small font-monospace mb-2" style="font-size: 0.75rem;"><code>$items = Database::fetchAll(
    "SELECT * FROM sample_items 
     WHERE deleted_at IS NULL 
     ORDER BY id DESC"
);</code></pre>
                    <p class="small text-muted mb-0">
                        Ibinabalik ang array ng mga rows na pwede nating i-loop gamit ang <code>foreach</code> sa HTML
                        table.
                    </p>
                </div>
            </div>

            <!-- 3. UPDATE CODE -->
            <div class="col-md-4">
                <div class="border rounded p-3 h-100 bg-light">
                    <h6 class="fw-bold text-marsu-burgundy mb-2">
                        <i class="bi bi-pencil-square text-gold me-1"></i>3. UPDATE (Pag-edit)
                    </h6>
                    <pre class="bg-dark text-white p-3 rounded small font-monospace mb-2" style="font-size: 0.75rem;"><code>Database::update('sample_items', [
    'title'      => $_POST['title'],
    'category'   => $_POST['category'],
    'updated_at' => date('Y-m-d H:i:s')
], 'id = :id', ['id' => $id]);</code></pre>
                    <p class="small text-muted mb-0">
                        Bibilangin ang ID at papalitan lamang ang row kung saan nag-match ang <code>id</code>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================================== -->
<!-- 3. UPDATE MODAL (HAKBANG 3: EDIT POPUP WINDOW) -->
<!-- ============================================================================== -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
                <h5 class="modal-title fs-6 fw-bold" id="editItemModalLabel">
                    <i class="bi bi-pencil-square me-2 text-gold"></i>3. UPDATE (I-edit ang Record)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
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
                        <input type="text" name="title" id="edit_title" class="form-control" required>
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