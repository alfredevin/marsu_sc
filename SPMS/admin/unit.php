<?php
include './../config.php';

// --- HELPER FUNCTION: SweetAlert Toast ---
// This keeps your code clean by reusing the alert logic
function showAlert($icon, $title)
{
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer)
                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
            });
            Toast.fire({ icon: "' . $icon . '", title: "' . $title . '" });
        });
    </script>';
}

// --- ADD UNIT ---
if (isset($_POST['submit'])) {
    $unit_name = strtoupper(trim($_POST['unit_name']));

    // Check if unit already exists
    $check_stmt = mysqli_prepare($conn, "SELECT unit_id FROM unit_tbl WHERE unit_name = ?");
    mysqli_stmt_bind_param($check_stmt, "s", $unit_name);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Unit Name Already Exists!');
    } else {
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO unit_tbl (unit_name) VALUES (?)");
        mysqli_stmt_bind_param($insert_stmt, "s", $unit_name);

        if (mysqli_stmt_execute($insert_stmt)) {
            showAlert('success', 'Unit Added Successfully!');
        } else {
            showAlert('error', 'Failed to Add Unit.');
        }
        mysqli_stmt_close($insert_stmt);
    }
    mysqli_stmt_close($check_stmt);
}

// --- UPDATE UNIT ---
if (isset($_POST['update_unit'])) {
    $unit_id = intval($_POST['unit_id']);
    $unit_name = strtoupper(trim($_POST['unit_name']));

    // Check duplicate excluding current ID
    $check_stmt = mysqli_prepare($conn, "SELECT unit_id FROM unit_tbl WHERE unit_name = ? AND unit_id != ?");
    mysqli_stmt_bind_param($check_stmt, "si", $unit_name, $unit_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Unit Name Already Exists!');
    } else {
        $update_stmt = mysqli_prepare($conn, "UPDATE unit_tbl SET unit_name = ? WHERE unit_id = ?");
        mysqli_stmt_bind_param($update_stmt, "si", $unit_name, $unit_id);

        if (mysqli_stmt_execute($update_stmt)) {
            showAlert('success', 'Unit Updated Successfully!');
        } else {
            showAlert('error', 'Failed to Update Unit.');
        }
        mysqli_stmt_close($update_stmt);
    }
    mysqli_stmt_close($check_stmt);
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
            <h1>Unit Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Manage Units</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-plus-circle-fill me-2"></i>Add New Unit</h5>

                            <form class="row g-3 needs-validation" method="POST" novalidate>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="uName" name="unit_name" placeholder="Example: HR Department" required oninput="this.value = this.value.toUpperCase();">
                                        <label for="uName">Unit Name</label>
                                    </div>
                                </div>
                                <div class="col-12 d-grid">
                                    <button type="submit" name="submit" class="btn btn-primary py-2">
                                        <i class="bi bi-save me-1"></i> Save Unit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Existing Units</h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered datatable align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" width="70%">Unit Name</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $units = mysqli_query($conn, "SELECT * FROM unit_tbl ORDER BY unit_name ASC");
                                        while ($unit = mysqli_fetch_assoc($units)) {
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-dark">
                                                    <?php echo htmlspecialchars($unit['unit_name']); ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm rounded-pill edit-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editUnitModal"
                                                        data-id="<?php echo $unit['unit_id']; ?>"
                                                        data-name="<?php echo htmlspecialchars($unit['unit_name']); ?>">
                                                        <i class="bi bi-pencil-square"></i> Edit
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

    <div class="modal fade" id="editUnitModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Unit Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="unit_id" id="edit_unit_id">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="unit_name" id="edit_unit_name" placeholder="Unit Name" required oninput="this.value = this.value.toUpperCase();">
                            <label for="edit_unit_name">Unit Name</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_unit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>

    <script>
        // Clean JS to handle modal data population
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    document.getElementById('edit_unit_id').value = id;
                    document.getElementById('edit_unit_name').value = name;
                });
            });
        });
    </script>
</body>

</html>