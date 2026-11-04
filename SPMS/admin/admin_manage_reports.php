<?php
include './../config.php';
include '../template/header.php';

// --- HANDLE ADMIN ACTION ---
if (isset($_POST['final_action'])) {
    $report_id = $_POST['report_id'];
    $action = $_POST['action']; // 'Approved' or 'Rejected'
    $supply_remarks = $_POST['supply_remarks'];
    $issue_type = $_POST['issue_type'];
    $item_id = $_POST['item_id'];

    // Status Logic
    $final_status = ($action == 'Approved') ? 'Approved' : 'Rejected';

    // 1. Update Report Table
    $update_rep = "UPDATE property_issue_reports_tbl SET report_status = '$final_status', admin_remarks = '$supply_remarks' WHERE report_id = '$report_id'";
    mysqli_query($conn, $update_rep);

    // 2. Update Inventory Status (If Approved)
    if ($action == 'Approved') {
        $new_status = ($issue_type == 'Missing') ? 'Missing' : 'For Condemn';
        mysqli_query($conn, "UPDATE issuance_items_tbl SET status = '$new_status', remarks = '$supply_remarks' WHERE id = '$item_id'");
    } else {
        mysqli_query($conn, "UPDATE issuance_items_tbl SET status = 'Serviceable' WHERE id = '$item_id'");
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ icon: 'success', title: 'Success', text: 'Report processed successfully.', timer: 1500, showConfirmButton: false })
            .then(() => { window.location.href = 'admin_manage_reports.php'; });
        });
    </script>";
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Report Validation</h1>
            <p class="text-muted">Final validation of property issues endorsed by Deans.</p>
        </div>

        <section class="section">

            <ul class="nav nav-tabs nav-tabs-bordered mb-3" id="validationTabs" role="tablist">
            
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history">
                        <i class="bi bi-clock-history me-2"></i> Processed History
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-2">

                <div class="tab-pane fade show active" id="pending">
                    <div class="card shadow-sm border-top border-primary border-4">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary">Endorsed Reports (Action Required)</h5>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date Processed</th>
                                            <th>Department</th>
                                            <th>Item</th>
                                            <th>Issue</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query: Validated Reports (Approved or Rejected by Admin)
                                        $q_hist = "
                                            SELECT r.*, e.equipment_name, ii.property_number, dept.department_name
                                            FROM property_issue_reports_tbl r
                                            JOIN issuance_items_tbl ii ON r.issuance_item_id = ii.id
                                            JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                            JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                            JOIN employee_tbl emp ON r.reported_by_id = emp.employee_id
                                            JOIN department_tbl dept ON emp.department_id = dept.department_id
                                            WHERE r.report_status IN ('Approved', 'Rejected')
                                            ORDER BY r.date_reported DESC
                                        ";
                                        $res_hist = mysqli_query($conn, $q_hist);

                                        while ($row = mysqli_fetch_assoc($res_hist)) {
                                            $status = $row['report_status'];
                                            $st_badge = ($status == 'Approved') ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-danger">Rejected</span>';
                                        ?>
                                            <tr>
                                                <td><?= date("M d, Y", strtotime($row['date_reported'])) ?></td>
                                                <td><?= $row['department_name'] ?></td>
                                                <td>
                                                    <?= $row['equipment_name'] ?><br>
                                                    <small class="text-muted"><?= $row['property_number'] ?></small>
                                                </td>
                                                <td><?= $row['issue_type'] ?></td>
                                                <td><?= $st_badge ?></td>
                                                <td><small class="fst-italic text-muted">"<?= $row['admin_remarks'] ?>"</small></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="history">
                    <div class="card shadow-sm border-top border-secondary border-4">
                        <div class="card-body p-4">
                            <h5 class="card-title text-secondary">Processed Reports</h5>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date Processed</th>
                                            <th>Department</th>
                                            <th>Item</th>
                                            <th>Issue</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query: Validated Reports (Approved or Rejected by Admin)
                                        $q_hist = "
                                            SELECT r.*, e.equipment_name, ii.property_number, dept.department_name
                                            FROM property_issue_reports_tbl r
                                            JOIN issuance_items_tbl ii ON r.issuance_item_id = ii.id
                                            JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                            JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                            JOIN employee_tbl emp ON r.reported_by_id = emp.employee_id
                                            JOIN department_tbl dept ON emp.department_id = dept.department_id
                                            WHERE r.report_status IN ('Approved', 'Rejected')
                                            ORDER BY r.date_reported DESC
                                        ";
                                        $res_hist = mysqli_query($conn, $q_hist);

                                        while ($row = mysqli_fetch_assoc($res_hist)) {
                                            $status = $row['report_status'];
                                            $st_badge = ($status == 'Approved') ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-danger">Rejected</span>';
                                        ?>
                                            <tr>
                                                <td><?= date("M d, Y", strtotime($row['date_reported'])) ?></td>
                                                <td><?= $row['department_name'] ?></td>
                                                <td>
                                                    <?= $row['equipment_name'] ?><br>
                                                    <small class="text-muted"><?= $row['property_number'] ?></small>
                                                </td>
                                                <td><?= $row['issue_type'] ?></td>
                                                <td><?= $st_badge ?></td>
                                                <td><small class="fst-italic text-muted">"<?= $row['admin_remarks'] ?>"</small></td>
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

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>