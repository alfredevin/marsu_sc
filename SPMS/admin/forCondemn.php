<?php
include './../config.php';


?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle mb-3">
            <h1>List of For Condemn Equipment </h1>
            <p>This page displays the list of for condemn equipment.</p>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Equipment</h5>
                    <div class="mb-3">
                        <label for="departmentFilter">Filter by Department:</label>
                        <select id="departmentFilter" class="form-select" style="width:200px; display:inline-block;"
                            onchange="filterDepartment()">
                            <option value="">All Departments</option>
                            <?php
                            $depart = isset($_GET['departmentFilter']) ? $_GET['departmentFilter'] : '';
                            $dept_sql = "SELECT * FROM department_tbl";
                            $dept_result = mysqli_query($conn, $dept_sql);
                            while ($dept = mysqli_fetch_assoc($dept_result)) {
                                $selected = ($dept['department_id'] == $depart) ? "selected" : "";
                                echo "<option value='{$dept['department_id']}' $selected>{$dept['department_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Property No</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Equipment Name</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="equipmentTable">
                            <?php
                            $depart = isset($_GET['departmentFilter']) ? $_GET['departmentFilter'] : '';

                            $sql = "SELECT *, pr_tbl.status AS pStatus
                            FROM pr_tbl
                            INNER JOIN employee_tbl ON employee_tbl.employee_id = pr_tbl.employee_id
                            LEFT JOIN department_tbl ON department_tbl.department_id = employee_tbl.department_id
                            LEFT JOIN purchase_request_items_tbl ON purchase_request_items_tbl.item_id = pr_tbl.item_id
                            LEFT JOIN equipment_tbl ON equipment_tbl.equipment_id = purchase_request_items_tbl.equipment_id
                            LEFT JOIN unit_tbl ON unit_tbl.unit_id = equipment_tbl.unit_id
                            WHERE pr_tbl.status = 3";

                            if (!empty($depart)) {
                                $sql .= " AND department_tbl.department_id = '$depart'";
                            }

                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                switch ($row['pStatus']) {
                                    case 1:
                                        $status = 'Serviceable';
                                        break;
                                    case 2:
                                        $status = 'Missing';
                                        break;
                                    case 3:
                                        $status = 'For Condemn';
                                        break;
                                    case 4:
                                        $status = 'Condemned';
                                        break;
                                    default:
                                        $status = 'Unknown';
                                }

                                echo "<tr>
                            <td>{$status}</td>
                            <td>{$row['property_number']}</td>
                            <td>{$row['first_name']} {$row['last_name']}</td>
                            <td>{$row['department_name']}</td>
                            <td>{$row['equipment_name']}</td>
                            <td>{$row['unit_name']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['description']}</td>
                            <td>
                                <button type='button' class='btn btn-success btn-sm condemnBtn'
                                    data-id='{$row['pr_property_id']}'
                                    data-property='{$row['property_number']}'
                                    data-bs-toggle='modal'
                                    data-bs-target='#condemnModal'>
                                    Condemn
                                </button>
                            </td>
                        </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal dapat nasa labas ng loop -->
    <div class="modal fade" id="condemnModal" tabindex="-1" aria-labelledby="condemnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="condemnForm" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="condemnModalLabel">Confirm Condemn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to condemn this equipment?</p>
                        <p><strong id="propertyNoText"></strong></p>
                        <input type="hidden" name="pr_id" id="pr_id">

                        <div class="mb-3">
                            <label for="condemned_by" class="form-label">Condemned By</label>
                            <input type="text" class="form-control" id="condemned_by" name="condemned_by" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_condemned" class="form-label">Date Condemned</label>
                            <input type="text" class="form-control" id="date_condemned" name="date_condemned"
                                value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm Condemn</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function filterDepartment() {
            var dept = document.getElementById("departmentFilter").value;
            window.location.href = "?departmentFilter=" + dept;
        }

        // Populate modal data
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".condemnBtn").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    document.getElementById("pr_id").value = this.dataset.id;
                    document.getElementById("propertyNoText").innerText = this.dataset.property;
                });
            });
        });

        document.getElementById("condemnForm").addEventListener("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch("updatecondemn.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Success", "Equipment condemned successfully!", "success")
                            .then(() => location.reload());
                    } else {
                        Swal.fire("Error", data.message, "error");
                    }
                })
                .catch(err => {
                    Swal.fire("Error", err, "error");
                });
        });
    </script>
</body>

</html>