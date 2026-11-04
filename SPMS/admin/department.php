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

// --- ADD DEPARTMENT ---
if (isset($_POST['submit'])) {
    $department_name = strtoupper(trim($_POST['department_name']));

    // Check Duplicate
    $check_stmt = mysqli_prepare($conn, "SELECT department_id FROM department_tbl WHERE department_name = ?");
    mysqli_stmt_bind_param($check_stmt, "s", $department_name);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Department Already Exists!');
    } else {
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO department_tbl (department_name) VALUES (?)");
        mysqli_stmt_bind_param($insert_stmt, "s", $department_name);

        if (mysqli_stmt_execute($insert_stmt)) {
            showAlert('success', 'Department Added Successfully!');
        } else {
            showAlert('error', 'Failed to Add Department.');
        }
        mysqli_stmt_close($insert_stmt);
    }
    mysqli_stmt_close($check_stmt);
}

// --- UPDATE DEPARTMENT ---
if (isset($_POST['update_department'])) {
    $department_id = intval($_POST['department_id']);
    $department_name = strtoupper(trim($_POST['department_name']));

    // Check Duplicate (Excluding current ID)
    $check_stmt = mysqli_prepare($conn, "SELECT department_id FROM department_tbl WHERE department_name = ? AND department_id != ?");
    mysqli_stmt_bind_param($check_stmt, "si", $department_name, $department_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        showAlert('error', 'Department Name Already Exists!');
    } else {
        $update_stmt = mysqli_prepare($conn, "UPDATE department_tbl SET department_name = ? WHERE department_id = ?");
        mysqli_stmt_bind_param($update_stmt, "si", $department_name, $department_id);

        if (mysqli_stmt_execute($update_stmt)) {
            showAlert('success', 'Department Updated Successfully!');
        } else {
            showAlert('error', 'Failed to Update Department.');
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
            <h1>Department Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Departments</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-building me-2"></i>Add Department</h5>

                            <form class="row g-3 needs-validation" method="POST" novalidate>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="department_name" id="deptName" placeholder="Department" required oninput="this.value = this.value.toUpperCase();">
                                        <label for="deptName">Department Name</label>
                                    </div>
                                </div>
                                <div class="col-12 d-grid">
                                    <button type="submit" name="submit" class="btn btn-primary py-2">
                                        <i class="bi bi-plus-circle me-1"></i> Add Department
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Existing Departments</h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered datatable align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Department Name</th>
                                            <th scope="col" class="text-center" width="150">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $departments = mysqli_query($conn, "SELECT * FROM department_tbl ORDER BY department_name ASC");
                                        while ($dept = mysqli_fetch_assoc($departments)) {
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-dark">
                                                    <?php echo htmlspecialchars($dept['department_name']); ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm rounded-pill edit-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDepartmentModal"
                                                        data-id="<?php echo $dept['department_id']; ?>"
                                                        data-name="<?php echo htmlspecialchars($dept['department_name']); ?>">
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

    <div class="modal fade" id="editDepartmentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Department</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="department_id" id="edit_department_id">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="department_name" id="edit_department_name" placeholder="Department" required oninput="this.value = this.value.toUpperCase();">
                            <label for="edit_department_name">Department Name</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_department" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>

    <script>
        // Efficient Event Listener for Edit Buttons
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    document.getElementById('edit_department_id').value = id;
                    document.getElementById('edit_department_name').value = name;
                });
            });
        });
    </script>
</body>

</html>