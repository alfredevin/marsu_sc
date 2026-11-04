<?php
include './../config.php';




$tracking_number = $_GET['tracking_number'] ?? '';

$select_inventory = mysqli_query($conn, "SELECT * FROM inventory_tbl WHERE tracking_number = '$tracking_number'");
$inventory_data = mysqli_fetch_assoc($select_inventory);
$inventory_id_data = $inventory_data["inventory_id"] ?? '';
$employee_id = $_GET['employee_id'] ?? '';

/** ============================
 * PROCESS SAVE INVENTORY
 * ============================ */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pr_id'])) {
    $pr_ids = $_POST['pr_id'];
    $statuses = $_POST['status'];
    $inventory_id = $inventory_id_data; // single value

    if (!empty($inventory_id) && !empty($pr_ids)) {
        $insert_stmt = mysqli_prepare(
            $conn,
            "INSERT INTO inventory_items_tbl (inventory_id, pr_id, status,employee_id) VALUES (?, ?, ?,?)"
        );

        for ($i = 0; $i < count($pr_ids); $i++) {
            $pr_id = intval($pr_ids[$i]);
            $status = $statuses[$i];

            // Assuming inventory_id and pr_id are INT, status is VARCHAR
            mysqli_stmt_bind_param($insert_stmt, "iisi", $inventory_id, $pr_id, $status, $employee_id);
            mysqli_stmt_execute($insert_stmt);
        }

        mysqli_stmt_close($insert_stmt);

        // Redirect after saving to avoid resubmission
        // Redirect after saving to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF'] . "?tracking_number=$tracking_number&saved=1");
        exit;
    }
}

$sql = "SELECT *
        FROM pr_tbl
        LEFT JOIN purchase_request_items_tbl ON purchase_request_items_tbl.item_id = pr_tbl.item_id
        LEFT JOIN equipment_tbl ON equipment_tbl.equipment_id = purchase_request_items_tbl.equipment_id
        LEFT JOIN unit_tbl ON unit_tbl.unit_id = equipment_tbl.unit_id 
        WHERE pr_tbl.employee_id = '$employee_id'";

$result = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle mb-3">
            <h1>List Equipment </h1>
            <p class="text-success">Below is the list of equipment.</p>
            <a href="newInventory" class="btn btn-primary btn-sm">Back to Page</a>
        </div>
        <?php if (isset($_GET['saved']) && $_GET['saved'] == 1): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Successfully Saved!',
                    text: 'The inventory has been saved successfully.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    // Redirect after Swal closes
                    window.location.href = "<?= $_SERVER['PHP_SELF'] . '?tracking_number=' . $tracking_number ?>";
                });
            </script>
        <?php endif; ?>

        <form method="GET" class="mb-4" id="filterForm" autocomplete="off">
            <div class="row">
                <div class="col-md-5">
                    <label for="department_id" class="form-label">Select Department</label>
                    <select name="department_id" id="department_id" class="form-select" required>
                        <option value="">-- Select Department --</option>
                        <?php
                        $dept_query = mysqli_query($conn, "SELECT * FROM department_tbl");
                        while ($dept = mysqli_fetch_assoc($dept_query)) {
                            $selected = (isset($_GET['department_id']) && $_GET['department_id'] == $dept['department_id']) ? 'selected' : '';
                            echo "<option value='{$dept['department_id']}' $selected>{$dept['department_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="employee_id" class="form-label">Select Employee</label>
                    <select name="employee_id" id="employee_id" class="form-select" required>
                        <option value="">-- Select Employee --</option>
                        <?php
                        if (isset($_GET['department_id']) && $_GET['department_id'] != '') {
                            $dept_id = intval($_GET['department_id']);
                            $emp_query = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE department_id = $dept_id");
                            while ($emp = mysqli_fetch_assoc($emp_query)) {
                                $selected = (isset($_GET['employee_id']) && $_GET['employee_id'] == $emp['employee_id']) ? 'selected' : '';
                                $emp_name = $emp['first_name'] . ' ' . $emp['last_name'];
                                $emp_id = $emp['employee_id'];


                                $check_inventory = mysqli_query($conn, "
                                    SELECT * FROM inventory_items_tbl
                                    INNER JOIN inventory_tbl ON inventory_items_tbl.inventory_id = inventory_tbl.inventory_id 
                                    WHERE employee_id = '$emp_id' 
                                    AND DATE(inventory_date) = CURDATE()
                                ");
                                if (mysqli_num_rows($check_inventory) > 0) {
                                    echo "<option value='{$emp_id}' disabled style='color:red;'>$emp_name (Already Inventory Today)</option>";
                                } else {
                                    echo "<option value='{$emp_id}' $selected>$emp_name</option>";
                                }
                            }
                        }

                        ?>
                    </select>
                    <input type="hidden" name="tracking_number" value="<?= $tracking_number; ?>">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Filter</button>
                </div>
            </div>
        </form>
        <script>
            // AJAX for employee dropdown
            document.getElementById('department_id').addEventListener('change', function() {
                var deptId = this.value;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_employees?department_id=' + deptId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById('employee_id').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            });
        </script>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Equipment</h5>
                    <form method="POST" id="inventoryForm">
                        <input type="hidden" name="tracking_number" value="<?= $tracking_number ?>">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Property No</th>
                                    <th>Equipment Name</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td class="status-cell">
                                            <select name="status[]" class="form-control">
                                                <option value="SERVICEABLE">SERVICEABLE</option>
                                                <option value="MISSING">MISSING</option>
                                            </select>
                                            <input type="hidden" name="pr_id[]" value="<?= $row['pr_property_id'] ?>">
                                        </td>
                                        <td><?= $row['property_number'] ?></td>
                                        <td><?= $row['equipment_name'] ?></td>
                                        <td><?= $row['unit_name'] ?></td>
                                        <td><?= $row['price'] ?></td>
                                        <td><?= $row['description'] ?></td>
                                    </tr>


                                <?php } ?>
                            </tbody>


                            <tfoot>
                                <td colspan="5">
                                    <hr>
                                    <p>
                                        <span class="text-danger">Note : </span>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit voluptate optio quia voluptas asperiores quidem. Provident possimus ratione esse reiciendis eveniet animi, veniam officia libero harum dolor molestias, dolorum voluptatum.
                                    </p>
                                </td>
                                <td colspan="1">
                                    <hr>
                                    <button type="submit" class="btn btn-success btn-sm">SAVE INVENTORY</button>
                                </td>
                            </tfoot>
                        </table>
                    </form>


                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>