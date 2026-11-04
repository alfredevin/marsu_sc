<?php
include './../config.php';

// --- 1. GET FILTERS ---
$dept_filter = isset($_GET['dept']) ? $_GET['dept'] : '';
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';

// --- 2. BUILD QUERY ---
// We query from `issuance_items_tbl` because this tracks the physical item + property no + status
$sql = "SELECT 
            ii.property_number, 
            ii.status as item_status, 
            ii.remarks,
            e.equipment_name, 
            u.unit_name, 
            inv.unit_cost,
            emp.first_name, emp.last_name, 
            dept.department_name
        FROM issuance_items_tbl ii
        JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
        JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
        JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
        LEFT JOIN unit_tbl u ON e.unit_id = u.unit_id
        JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
        LEFT JOIN department_tbl dept ON emp.department_id = dept.department_id
        WHERE 1=1";

// Apply Department Filter
if (!empty($dept_filter)) {
    $sql .= " AND dept.department_id = '$dept_filter'";
}

// Apply Status Filter (Make sure these match your DB values: 'Serviceable', 'Missing', etc.)
if (!empty($status_filter)) {
    $sql .= " AND ii.status = '$status_filter'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle mb-4">
            <h1>Property Monitoring List</h1>
            <p class="text-muted">Master list of all issued equipment, their status, and accountability.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-primary border-4">
                <div class="card-body p-4">

                    <div class="row mb-4 g-3">
                        <div class="col-md-4">
                            <label class="fw-bold small text-muted mb-1">Filter by Department:</label>
                            <select id="deptFilter" class="form-select shadow-sm" onchange="applyFilters()">
                                <option value="">-- All Departments --</option>
                                <?php
                                $d_res = mysqli_query($conn, "SELECT * FROM department_tbl ORDER BY department_name");
                                while ($d = mysqli_fetch_assoc($d_res)) {
                                    $sel = ($d['department_id'] == $dept_filter) ? 'selected' : '';
                                    echo "<option value='{$d['department_id']}' $sel>{$d['department_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="fw-bold small text-muted mb-1">Filter by Status:</label>
                            <select id="statusFilter" class="form-select shadow-sm" onchange="applyFilters()">
                                <option value="">-- All Statuses --</option>
                                <option value="Serviceable" <?= ($status_filter == 'Serviceable') ? 'selected' : '' ?>>Serviceable</option>
                                <option value="Missing" <?= ($status_filter == 'Missing') ? 'selected' : '' ?>>Missing</option>
                                <option value="For Condemn" <?= ($status_filter == 'For Condemn') ? 'selected' : '' ?>>For Condemn</option>
                                <option value="Condemned" <?= ($status_filter == 'Condemned') ? 'selected' : '' ?>>Condemned</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <a href="property_monitoring.php" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Property No.</th>
                                    <th width="20%">Item Description</th>
                                    <th width="20%">Accountable Officer</th>
                                    <th width="15%">Department</th>
                                    <th width="10%" class="text-end">Unit Cost</th>
                                    <th width="10%" class="text-center">Status</th>
                                    <th width="10%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    // Status Badge Logic
                                    $stat = $row['item_status'] ?? 'Serviceable'; // Default

                                    if ($stat == 'Serviceable') {
                                        $badge = '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Serviceable</span>';
                                    } elseif ($stat == 'Missing') {
                                        $badge = '<span class="badge bg-danger"><i class="bi bi-question-circle"></i> Missing</span>';
                                    } elseif ($stat == 'For Condemn') {
                                        $badge = '<span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle"></i> For Condemn</span>';
                                    } elseif ($stat == 'Condemned') {
                                        $badge = '<span class="badge bg-secondary"><i class="bi bi-trash"></i> Condemned</span>';
                                    } else {
                                        $badge = '<span class="badge bg-light text-dark">' . $stat . '</span>';
                                    }
                                ?>
                                    <tr>
                                        <td class="fw-bold text-dark"><?= $row['property_number'] ?></td>

                                        <td>
                                            <strong><?= $row['equipment_name'] ?></strong><br>
                                            <small class="text-muted"><?= $row['unit_name'] ?></small>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light rounded-circle me-2 p-1 text-primary small">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border"><?= $row['department_name'] ?></span>
                                        </td>

                                        <td class="text-end fw-bold text-secondary">
                                            ₱<?= number_format($row['unit_cost'], 2) ?>
                                        </td>

                                        <td class="text-center">
                                            <?= $badge ?>
                                        </td>

                                        <td>
                                            <small class="text-muted fst-italic">
                                                <?= !empty($row['remarks']) ? substr($row['remarks'], 0, 30) . '...' : '-' ?>
                                            </small>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        function applyFilters() {
            var dept = document.getElementById("deptFilter").value;
            var status = document.getElementById("statusFilter").value;

            // Build URL with params
            var url = "?";
            if (dept) url += "dept=" + dept + "&";
            if (status) url += "status=" + status;

            window.location.href = url;
        }
    </script>
</body>

</html>