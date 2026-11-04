<?php
include './../config.php';

// --- HELPER FUNCTION: SweetAlert Toast ---
function showAlert($icon, $title)
{
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({ icon: "' . $icon . '", title: "' . $title . '" });
        });
    </script>';
}

// --- ADD EQUIPMENT/SUPPLY ---
if (isset($_POST['submit'])) {
    $equipment_name = strtoupper(trim($_POST['equipment_name']));
    $unit_id = $_POST['unit_id'];
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];

    $check_stmt = mysqli_prepare($conn, "SELECT equipment_id FROM equipment_tbl WHERE equipment_name = ? AND unit_id = ?");
    mysqli_stmt_bind_param($check_stmt, "si", $equipment_name, $unit_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Item Already Exists!');
    } else {
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO equipment_tbl (equipment_name, unit_id, description, price, category) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_stmt, "sisds", $equipment_name, $unit_id, $description, $price, $category);
        if (mysqli_stmt_execute($insert_stmt)) showAlert('success', 'Item Added Successfully!');
        mysqli_stmt_close($insert_stmt);
    }
}

// --- UPDATE EQUIPMENT/SUPPLY ---
if (isset($_POST['update_item'])) {
    $id = $_POST['equipment_id'];
    $cat = $_POST['category'];
    $desc = trim($_POST['description']);
    $prc = $_POST['price'];

    $upd_stmt = mysqli_prepare($conn, "UPDATE equipment_tbl SET category = ?, description = ?, price = ? WHERE equipment_id = ?");
    mysqli_stmt_bind_param($upd_stmt, "ssdi", $cat, $desc, $prc, $id);

    if (mysqli_stmt_execute($upd_stmt)) {
        showAlert('success', 'Item Updated Successfully!');
    } else {
        showAlert('error', 'Update Failed.');
    }
    mysqli_stmt_close($upd_stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Inventory Management</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm border-top border-primary border-3">
                        <div class="card-body p-4">
                            <h5 class="card-title">Add New Item</h5>
                            <form class="row g-3" method="POST">
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Item Name</label>
                                    <input type="text" class="form-control" name="equipment_name" required oninput="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold">Category</label>
                                    <select class="form-select" name="category" required>
                                        <option value="Equipment">Equipment</option>
                                        <option value="Supply">Supply</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold">Unit</label>
                                    <select class="form-select" name="unit_id" required>
                                        <?php
                                        $units = mysqli_query($conn, "SELECT * FROM unit_tbl");
                                        while ($u = mysqli_fetch_assoc($units)) echo "<option value='{$u['unit_id']}'>{$u['unit_name']}</option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Price (₱)</label>
                                    <input type="number" step="0.01" class="form-control" name="price" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Description</label>
                                    <textarea class="form-control" name="description" rows="2"></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary w-100">Add Item</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title">Inventory List <small class="text-muted fs-6">(New items at the top)</small></h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Item Name</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // LOGIC: Unahin ang 'Uncategorized' at pinaka-bagong gawa
                                        $sql = "SELECT e.*, u.unit_name FROM equipment_tbl e 
                                                LEFT JOIN unit_tbl u ON e.unit_id = u.unit_id 
                                                ORDER BY 
                                                    CASE WHEN e.category = 'Uncategorized' THEN 0 ELSE 1 END, 
                                                    e.created_at DESC";
                                        $res = mysqli_query($conn, $sql);
                                        while ($eq = mysqli_fetch_assoc($res)) {
                                            $is_new = ($eq['category'] == 'Uncategorized');
                                            $badge = $is_new ? 'bg-danger' : ($eq['category'] == 'Equipment' ? 'bg-primary' : 'bg-success');
                                        ?>
                                            <tr class="<?= $is_new ? 'table-warning' : '' ?>">
                                                <td>
                                                    <span class="fw-bold d-block"><?= $eq['equipment_name'] ?></span>
                                                    <small class="text-muted"><?= $eq['description'] ?></small>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge rounded-pill <?= $badge ?>"><?= $eq['category'] ?></span>
                                                </td>
                                                <td class="text-end">₱<?= number_format($eq['price'], 2) ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-secondary"
                                                        onclick="editItem(<?= htmlspecialchars(json_encode($eq)) ?>)">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Item: <span id="edit_title" class="fw-bold"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="equipment_id" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Update Category</label>
                            <select class="form-select" name="category" id="edit_cat" required>
                                <option value="Uncategorized">Uncategorized</option>
                                <option value="Equipment">Equipment</option>
                                <option value="Supply">Supply</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Unit Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="edit_price" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Description</label>
                            <textarea class="form-control" name="description" id="edit_desc" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update_item" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php include '../template/script.php'; ?>

    <script>
        function editItem(data) {
            document.getElementById('edit_id').value = data.equipment_id;
            document.getElementById('edit_title').innerText = data.equipment_name;
            document.getElementById('edit_cat').value = data.category;
            document.getElementById('edit_price').value = data.price;
            document.getElementById('edit_desc').value = data.description;

            var myModal = new bootstrap.Modal(document.getElementById('editModal'));
            myModal.show();
        }
    </script>
</body>

</html>