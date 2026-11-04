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

// --- ADD POSITION ---
if (isset($_POST['submit'])) {
    $position_name = strtoupper(trim($_POST['position_name']));

    // Check Duplicate
    $check_stmt = mysqli_prepare($conn, "SELECT position_id FROM position_tbl WHERE position_name = ?");
    mysqli_stmt_bind_param($check_stmt, "s", $position_name);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Position Already Exists!');
    } else {
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO position_tbl (position_name) VALUES (?)");
        mysqli_stmt_bind_param($insert_stmt, "s", $position_name);

        if (mysqli_stmt_execute($insert_stmt)) {
            showAlert('success', 'Position Added Successfully!');
        } else {
            showAlert('error', 'Failed to Add Position.');
        }
        mysqli_stmt_close($insert_stmt);
    }
    mysqli_stmt_close($check_stmt);
}

// --- UPDATE POSITION ---
if (isset($_POST['update_position'])) {
    $position_id = intval($_POST['position_id']);
    $position_name = strtoupper(trim($_POST['edit_position_name']));

    // Check duplicate excluding itself
    $check_dup = mysqli_prepare($conn, "SELECT position_id FROM position_tbl WHERE position_name = ? AND position_id != ?");
    mysqli_stmt_bind_param($check_dup, "si", $position_name, $position_id);
    mysqli_stmt_execute($check_dup);
    mysqli_stmt_store_result($check_dup);

    if (mysqli_stmt_num_rows($check_dup) > 0) {
        showAlert('error', 'Position Name Already Exists!');
    } else {
        $update_stmt = mysqli_prepare($conn, "UPDATE position_tbl SET position_name = ? WHERE position_id = ?");
        mysqli_stmt_bind_param($update_stmt, "si", $position_name, $position_id);

        if (mysqli_stmt_execute($update_stmt)) {
            showAlert('success', 'Position Updated Successfully!');
        } else {
            showAlert('error', 'Failed to Update Position.');
        }
        mysqli_stmt_close($update_stmt);
    }
    mysqli_stmt_close($check_dup);
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
            <h1>Position Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Positions</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-briefcase-fill me-2"></i>Add New Position</h5>

                            <form method="POST" class="row g-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="position_name" id="posName" placeholder="Position" required oninput="this.value=this.value.toUpperCase();">
                                        <label for="posName">Position Name</label>
                                    </div>
                                </div>
                                <div class="col-12 d-grid">
                                    <button type="submit" name="submit" class="btn btn-primary py-2">
                                        <i class="bi bi-plus-lg me-1"></i> Add Position
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Existing Positions</h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered datatable align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Position Name</th>
                                            <th scope="col" class="text-center" width="150">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM position_tbl ORDER BY position_name ASC");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-dark">
                                                    <?php echo htmlspecialchars($row['position_name']); ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm rounded-pill edit-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editPositionModal"
                                                        data-id="<?php echo $row['position_id']; ?>"
                                                        data-name="<?php echo htmlspecialchars($row['position_name']); ?>">
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

    <div class="modal fade" id="editPositionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Position</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="position_id" id="edit_position_id">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="edit_position_name" id="edit_position_name" placeholder="Position" required oninput="this.value=this.value.toUpperCase();">
                            <label for="edit_position_name">Position Name</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_position" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        // Efficient Event Listener for Edit Buttons
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    document.getElementById('edit_position_id').value = id;
                    document.getElementById('edit_position_name').value = name;
                });
            });
        });
    </script>
</body>

</html>