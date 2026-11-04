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
            <h1>List of Condemned Equipment </h1>
            <p>This page displays the list of condemned equipment.</p>
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
                                <th>Property No</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Equipment Name</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Condemned By</th>
                                <th>Date Condemned</th>
                            </tr>
                        </thead>
                        <tbody id="equipmentTable">
                            <?php
                            $counter = 1;
                            $depart = isset($_GET['departmentFilter']) ? $_GET['departmentFilter'] : '';

                            $sql = "SELECT *, pr_tbl.status AS pStatus
                            FROM  condemned_tbl
                            INNER JOIN pr_tbl ON pr_tbl.pr_property_id = condemned_tbl.condemned_pr_id
                            LEFT JOIN employee_tbl ON employee_tbl.employee_id = pr_tbl.employee_id
                            LEFT JOIN department_tbl ON department_tbl.department_id = employee_tbl.department_id
                            LEFT JOIN purchase_request_items_tbl ON purchase_request_items_tbl.item_id = pr_tbl.item_id
                            LEFT JOIN equipment_tbl ON equipment_tbl.equipment_id = purchase_request_items_tbl.equipment_id
                            LEFT JOIN unit_tbl ON unit_tbl.unit_id = equipment_tbl.unit_id
                            WHERE pr_tbl.status = 4";

                            if (!empty($depart)) {
                                $sql .= " AND department_tbl.department_id = '$depart'";
                            }

                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>{$row['property_number']}</td>
                                <td>{$row['first_name']} {$row['last_name']}</td>
                                <td>{$row['department_name']}</td>
                                <td>{$row['equipment_name']}</td>
                                <td>{$row['unit_name']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['condemned_by']}</td>
                                <td>{$row['date_condemned']}</td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function filterDepartment() {
            var dept = document.getElementById("departmentFilter").value;
            window.location.href = "?departmentFilter=" + dept;
        }
    </script>

</body>

</html>