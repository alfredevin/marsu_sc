<?php
include './../config.php';
include '../template/header.php';

?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>
    <?php

    // --- HANDLE ACTION ---
    if (isset($_POST['process_report'])) {
        $report_id = $_POST['report_id'];
        $item_id = $_POST['item_id'];
        $action = $_POST['action']; // 'Approved' or 'Rejected'
        $admin_remarks = $_POST['admin_remarks'];
        $issue_type = $_POST['issue_type'];

        // 1. Update Report Table
        $update_rep = "UPDATE property_issue_reports_tbl SET report_status = '$action', admin_remarks = '$admin_remarks' WHERE report_id = '$report_id'";
        mysqli_query($conn, $update_rep);

        // 2. Update Inventory Status (If Approved)
        if ($action == 'Approved') {
            // Change status to "Missing" or "For Condemn" officially
            $new_status = ($issue_type == 'Missing') ? 'Missing' : 'For Condemn';
            mysqli_query($conn, "UPDATE issuance_items_tbl SET status = '$new_status', remarks = '$admin_remarks' WHERE id = '$item_id'");
        } else {
            // If Rejected, revert to Serviceable
            mysqli_query($conn, "UPDATE issuance_items_tbl SET status = 'Serviceable' WHERE id = '$item_id'");
        }

        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ icon: 'success', title: 'Report Processed', text: 'Inventory status has been updated.', timer: 1500, showConfirmButton: false })
            .then(() => { window.location.href = 'dean_manage_reports.php'; });
        });
    </script>";
    }
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Reported Issues</h1>
            <p class="text-muted">Review and validate property issues reported by your staff.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-warning border-4">
                <div class="card-body p-4">
                    <h5 class="card-title text-warning">Pending Reports</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date Reported</th>
                                    <th>Employee</th>
                                    <th>Item Details</th>
                                    <th>Issue Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Get Pending Reports from Employees in this Department
                                $query = "
                                    SELECT r.*, 
                                           e.equipment_name, ii.property_number,
                                           emp.first_name, emp.last_name
                                    FROM property_issue_reports_tbl r
                                    JOIN issuance_items_tbl ii ON r.issuance_item_id = ii.id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    JOIN employee_tbl emp ON r.reported_by_id = emp.employee_id
                                    WHERE emp.department_id = '$dept_id' AND r.report_status = 'Pending'
                                    ORDER BY r.date_reported DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $rid = $row['report_id'];
                                        $badge = ($row['issue_type'] == 'Missing') ? 'bg-danger' : 'bg-warning text-dark';
                                ?>
                                        <tr>
                                            <td><?= date("M d, Y", strtotime($row['date_reported'])) ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle me-2 p-1 small text-primary text-center" style="width:30px;">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                    <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <strong><?= $row['equipment_name'] ?></strong><br>
                                                <small class="text-muted"><?= $row['property_number'] ?></small>
                                            </td>
                                            <td><span class="badge <?= $badge ?>"><?= $row['issue_type'] ?></span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#reviewModal_<?= $rid ?>">
                                                    Review & Action
                                                </button>

                                                <div class="modal fade text-start" id="reviewModal_<?= $rid ?>" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="POST">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Validate Report</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="alert alert-light border">
                                                                        <small class="fw-bold text-uppercase text-muted">Incident Description:</small>
                                                                        <p class="mb-0 fst-italic">"<?= $row['description'] ?>"</p>
                                                                        <hr>
                                                                        <small>Incident Date: <strong><?= date("F d, Y", strtotime($row['date_incident'])) ?></strong></small>
                                                                    </div>

                                                                    <input type="hidden" name="report_id" value="<?= $rid ?>">
                                                                    <input type="hidden" name="item_id" value="<?= $row['issuance_item_id'] ?>">
                                                                    <input type="hidden" name="issue_type" value="<?= $row['issue_type'] ?>">

                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Dean's Remarks / Validation Note</label>
                                                                        <textarea name="admin_remarks" class="form-control" required placeholder="E.g. Verified via ocular inspection..."></textarea>
                                                                    </div>

                                                                    <div class="d-grid gap-2">
                                                                        <button type="submit" name="process_report" value="Approved" class="btn btn-success" onclick="this.form.action.value='Approved'">
                                                                            <i class="bi bi-check-circle me-2"></i> Confirm as <?= $row['issue_type'] ?>
                                                                        </button>
                                                                        <button type="submit" name="process_report" value="Rejected" class="btn btn-outline-danger" onclick="this.form.action.value='Rejected'">
                                                                            <i class="bi bi-x-circle me-2"></i> Reject Report (Item is OK)
                                                                        </button>
                                                                        <input type="hidden" name="action" id="action_input_<?= $rid ?>">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center p-5 text-muted'>No pending reports to review.</td></tr>";
                                }
                                ?>
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
        // Note: The inline onclick="this.form.action.value='Approved'" handles the logic simply.
    </script>
</body>

</html>