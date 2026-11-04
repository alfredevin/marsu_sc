<?php
include './../config.php';

if (isset($_POST['submit'])) {
    $inventory_date = $_POST['inventory_date'];
    $inventory_by = strtoupper(trim($_POST['inventory_by']));
    $tracking_number = strtoupper(trim($_POST['tracking_number']));

    // Check if tracking number already exists
    $check_stmt = mysqli_prepare($conn, "SELECT * FROM inventory_tbl WHERE tracking_number = ?");
    mysqli_stmt_bind_param($check_stmt, "s", $tracking_number);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>Swal.fire('Error!', 'Tracking Number already exists!', 'error');</script>";
    } else {
        // Insert new inventory record
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO inventory_tbl (inventory_date, inventory_by, tracking_number) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($insert_stmt, "sss", $inventory_date, $inventory_by, $tracking_number);

        if (mysqli_stmt_execute($insert_stmt)) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end", 
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: "success",
                    title: "Inventory Added Successfully!!!"
                }) 
            });
        </script>';
        } else {
            echo "<script>Swal.fire('Error!', 'Failed to add inventory.', 'error');</script>";
        }

        mysqli_stmt_close($insert_stmt);
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
            <h1>Add Inventory</h1>
            <p>This section allows administrators to manage inventory records.</p>
        </div>

        <section class="section">
            <div class="row">
                <!-- Add Inventory Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Inventory</h5>
                            <form class="row g-3" method="POST">
                                <div class="col-12">
                                    <label class="form-label">Inventory Date</label>
                                    <input type="date" class="form-control" name="inventory_date" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Inventory By</label>
                                    <input type="text" class="form-control" name="inventory_by" required oninput="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control" name="tracking_number" value="<?php echo 'INV-' . strtoupper(uniqid()); ?>" readonly>
                                </div>
                                <div class="text-end">
                                    <button type="submit" name="submit" class="btn btn-primary">Add Inventory</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- List of Inventories -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body" style="overflow-x: auto;">
                            <h5 class="card-title">List of Inventories</h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th>Inventory Date</th>
                                        <th>Inventory By</th>
                                        <th>Tracking Number</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $inventories = mysqli_query($conn, "SELECT * FROM inventory_tbl ORDER BY inventory_date DESC");
                                    while ($inv = mysqli_fetch_assoc($inventories)) {
                                        echo "<tr>";
                                        echo "<td>" . $inv['inventory_date'] . "</td>";
                                        echo "<td>" . $inv['inventory_by'] . "</td>";
                                        echo "<td>" . $inv['tracking_number'] . "</td>";
                                        echo "<td>
                                                <a href='employee_inventory?tracking_number=" . urlencode($inv['tracking_number']) . "' class='btn btn-sm btn-primary'>
                                                    Start Inventory
                                                </a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>
</body>

</html>