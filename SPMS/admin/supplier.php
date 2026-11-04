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

// --- ADD SUPPLIER ---
if (isset($_POST['add_supplier'])) {
    $name = strtoupper(trim($_POST['supplier_name']));
    $contact_person = strtoupper(trim($_POST['contact_person']));
    $contact_number = trim($_POST['contact_number']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    // Check duplicate
    $check_stmt = $conn->prepare("SELECT supplier_id FROM supplier_tbl WHERE supplier_name = ? OR email = ?");
    $check_stmt->bind_param("ss", $name, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        showAlert('error', 'Supplier Name or Email Already Exists!');
    } else {
        $insert_stmt = $conn->prepare("INSERT INTO supplier_tbl (supplier_name, contact_person, contact_number, email, address) VALUES (?,?,?,?,?)");
        $insert_stmt->bind_param("sssss", $name, $contact_person, $contact_number, $email, $address);

        if ($insert_stmt->execute()) {
            showAlert('success', 'Supplier Added Successfully!');
        } else {
            showAlert('error', 'Failed to Add Supplier.');
        }
        $insert_stmt->close();
    }
    $check_stmt->close();
}

// --- EDIT SUPPLIER ---
if (isset($_POST['update_supplier'])) {
    $id = $_POST['supplier_id'];
    $name = strtoupper(trim($_POST['supplier_name']));
    $contact_person = strtoupper(trim($_POST['contact_person']));
    $contact_number = trim($_POST['contact_number']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    // Check duplicate excluding current ID
    $check_stmt = $conn->prepare("SELECT supplier_id FROM supplier_tbl WHERE (supplier_name = ? OR email = ?) AND supplier_id != ?");
    $check_stmt->bind_param("ssi", $name, $email, $id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        showAlert('error', 'Supplier details conflict with another record!');
    } else {
        $update_stmt = $conn->prepare("UPDATE supplier_tbl SET supplier_name=?, contact_person=?, contact_number=?, email=?, address=? WHERE supplier_id=?");
        $update_stmt->bind_param("sssssi", $name, $contact_person, $contact_number, $email, $address, $id);

        if ($update_stmt->execute()) {
            showAlert('success', 'Supplier Updated Successfully!');
        } else {
            showAlert('error', 'Failed to Update Supplier.');
        }
        $update_stmt->close();
    }
    $check_stmt->close();
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
            <h1>Supplier Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Suppliers</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-shop-window me-2"></i>Add Supplier</h5>

                            <form method="POST" class="row g-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="supplier_name" class="form-control" id="sName" placeholder="Company Name" required oninput="this.value = this.value.toUpperCase();">
                                        <label for="sName">Supplier Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="contact_person" class="form-control" id="cPerson" placeholder="Person" required oninput="this.value = this.value.toUpperCase();">
                                        <label for="cPerson">Contact Person</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="contact_number" class="form-control" id="cNum" placeholder="Phone" required>
                                        <label for="cNum">Contact Number</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="cEmail" placeholder="Email" required>
                                        <label for="cEmail">Email Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="address" class="form-control" id="cAddress" placeholder="Address" style="height: 100px;"></textarea>
                                        <label for="cAddress">Address</label>
                                    </div>
                                </div>
                                <div class="col-12 d-grid">
                                    <button type="submit" name="add_supplier" class="btn btn-primary py-2">
                                        <i class="bi bi-save me-1"></i> Save Supplier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Supplier List</h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered datatable align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Contact Info</th>
                                            <th>Address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // d_status check assumes you have a status column. If not, remove "WHERE status=1"
                                        $suppliers = mysqli_query($conn, "SELECT * FROM supplier_tbl WHERE status=1 ORDER BY supplier_id DESC");
                                        while ($sup = mysqli_fetch_assoc($suppliers)) { ?>
                                            <tr>
                                                <td class="fw-bold text-primary">
                                                    <?php echo htmlspecialchars($sup['supplier_name']); ?><br>
                                                    <small class="text-muted fw-normal">
                                                        <i class="bi bi-person me-1"></i><?php echo htmlspecialchars($sup['contact_person']); ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <small class="d-block"><i class="bi bi-telephone me-1"></i><?php echo htmlspecialchars($sup['contact_number']); ?></small>
                                                    <small class="d-block text-muted"><i class="bi bi-envelope me-1"></i><?php echo htmlspecialchars($sup['email']); ?></small>
                                                </td>
                                                <td><small><?php echo htmlspecialchars($sup['address']); ?></small></td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm rounded-pill edit-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editSupplierModal"
                                                        data-id="<?php echo $sup['supplier_id']; ?>"
                                                        data-name="<?php echo htmlspecialchars($sup['supplier_name']); ?>"
                                                        data-person="<?php echo htmlspecialchars($sup['contact_person']); ?>"
                                                        data-number="<?php echo htmlspecialchars($sup['contact_number']); ?>"
                                                        data-email="<?php echo htmlspecialchars($sup['email']); ?>"
                                                        data-address="<?php echo htmlspecialchars($sup['address']); ?>">
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

    <div class="modal fade" id="editSupplierModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Supplier</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="supplier_id" id="edit_supplier_id">

                        <div class="form-floating mb-3">
                            <input type="text" name="supplier_name" id="edit_supplier_name" class="form-control" placeholder="Name" required oninput="this.value = this.value.toUpperCase();">
                            <label>Supplier Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="contact_person" id="edit_contact_person" class="form-control" placeholder="Person" required oninput="this.value = this.value.toUpperCase();">
                            <label>Contact Person</label>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" name="contact_number" id="edit_contact_number" class="form-control" placeholder="Phone" required>
                                    <label>Contact Number</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="email" name="email" id="edit_email" class="form-control" placeholder="Email" required>
                                    <label>Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea name="address" id="edit_address" class="form-control" placeholder="Address" style="height: 100px;"></textarea>
                            <label>Address</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_supplier" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        // Efficient Javascript to handle data transfer to Modal
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data from attributes
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const person = this.getAttribute('data-person');
                    const number = this.getAttribute('data-number');
                    const email = this.getAttribute('data-email');
                    const address = this.getAttribute('data-address');

                    // Set values in modal inputs
                    document.getElementById('edit_supplier_id').value = id;
                    document.getElementById('edit_supplier_name').value = name;
                    document.getElementById('edit_contact_person').value = person;
                    document.getElementById('edit_contact_number').value = number;
                    document.getElementById('edit_email').value = email;
                    document.getElementById('edit_address').value = address;
                });
            });
        });
    </script>
</body>

</html>