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

            echo "<option value='{$emp_id}'>$emp_name</option>";
        }
    } else {
        echo '<option value="">No employees found</option>';
    }
} else {
    echo '<option value="">-- Select Employee --</option>';
}
