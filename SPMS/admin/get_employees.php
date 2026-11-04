<?php
include './../config.php';

if (isset($_GET['department_id']) && !empty($_GET['department_id'])) {
    $dept_id = intval($_GET['department_id']);
    $emp_query = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE department_id = $dept_id ORDER BY first_name ASC");

    if (mysqli_num_rows($emp_query) > 0) {
        echo '<option value="">-- Select Employee --</option>';
        while ($emp = mysqli_fetch_assoc($emp_query)) {
            $emp_name = htmlspecialchars($emp['first_name'] . ' ' . $emp['last_name']);
            $emp_id   = $emp['employee_id'];

            // ✅ Check if employee already has inventory today
            $check_inventory = mysqli_query($conn, "
                SELECT * FROM inventory_items_tbl
                INNER JOIN inventory_tbl ON inventory_items_tbl.inventory_id = inventory_tbl.inventory_id
                WHERE employee_id = '$emp_id'
                AND DATE(inventory_date) = CURDATE()
            ");

            if (mysqli_num_rows($check_inventory) > 0) {
                echo "<option value='{$emp_id}' disabled style='color:red;'>$emp_name (Already Inventory Today)</option>";
            } else {
                echo "<option value='{$emp_id}'>$emp_name</option>";
            }
        }
    } else {
        echo '<option value="">No employees found</option>';
    }
} else {
    echo '<option value="">-- Select Employee --</option>';
}
?>
