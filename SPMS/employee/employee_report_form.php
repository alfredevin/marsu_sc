<?php
include './../config.php';
include '../template/header.php';

// $my_id = $_SESSION['employee_id']; 
$my_id = 1;

// --- HANDLE BULK REPORT SUBMISSION ---
if (isset($_POST['submit_bulk_report'])) {
    // Check if ANY item has an issue type selected
    $has_selection = false;

    if (isset($_POST['issue_type'])) {
        foreach ($_POST['issue_type'] as $id => $type) {
            // Only process items where a type (Missing/Condemn) is selected
            if (!empty($type)) {
                $has_selection = true;
                $desc = $_POST['remarks'][$id];
                $incident_date = $_POST['date_incident']; // One date for batch

                // 1. Insert Report
                $stmt = mysqli_prepare($conn, "INSERT INTO property_issue_reports_tbl (issuance_item_id, reported_by_id, issue_type, description, date_incident, report_status) VALUES (?, ?, ?, ?, ?, 'Pending')");
                mysqli_stmt_bind_param($stmt, "iisss", $id, $my_id, $type, $desc, $incident_date);
                mysqli_stmt_execute($stmt);

                // 2. Update Item Status
                $status_label = ($type == 'Missing') ? 'Reported - Missing' : 'Reported - Damaged';
                mysqli_query($conn, "UPDATE issuance_items_tbl SET status = '$status_label' WHERE id = '$id'");
            }
        }
    }

    if ($has_selection) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ icon: 'success', title: 'Reports Submitted!', text: 'Supply Office notified.', confirmButtonColor: '#dc3545' })
                .then(() => { window.location.href = 'employee_report_form.php'; });
            });
        </script>";
    } else {
        echo "<script>alert('Please select an issue type for at least one item.');</script>";
    }
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Report Property Issues</h1>
        </div>

        <section class="section">
            <form method="POST" id="reportForm">
                <div class="card shadow border-top border-danger border-4">
                    <div class="card-body p-4">

                        <div class="alert alert-warning">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <strong>Instructions:</strong> Select the <b>Issue Type</b> (Missing/Damaged) for the items you want to report. Leave it blank ("-- Select --") if the item is okay.
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Date of Incident</label>
                                <input type="date" name="date_incident" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle border">
                                <thead class="table-light">
                                    <tr>
                                        <th width="15%">Property No.</th>
                                        <th width="25%">Item Description</th>
                                        <th width="20%">Issue Type</th>
                                        <th width="40%">Remarks / Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "
                                        SELECT ii.id, ii.property_number, e.equipment_name, u.unit_name
                                        FROM issuance_items_tbl ii
                                        JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                        JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                        JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                        LEFT JOIN unit_tbl u ON e.unit_id = u.unit_id
                                        WHERE i.issued_to_user_id = '$my_id' 
                                        AND (ii.status IS NULL OR ii.status = 'Serviceable') 
                                        AND i.type = 'PAR'
                                        ORDER BY e.equipment_name ASC
                                    ";
                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                    ?>
                                            <tr>
                                                <td class="fw-bold text-dark"><?= $row['property_number'] ?></td>
                                                <td>
                                                    <?= $row['equipment_name'] ?><br>
                                                    <small class="text-muted"><?= $row['unit_name'] ?></small>
                                                </td>

                                                <td>
                                                    <select name="issue_type[<?= $id ?>]" class="form-select form-select-sm border-danger text-danger fw-bold" onchange="toggleRemarks(<?= $id ?>)">
                                                        <option value="">-- No Issue --</option>
                                                        <option value="Missing">Missing / Lost</option>
                                                        <option value="For Condemn">Damaged (Condemn)</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" name="remarks[<?= $id ?>]" id="remarks_<?= $id ?>"
                                                        class="form-control form-control-sm"
                                                        placeholder="Required: State reason..."
                                                        style="display: none;">
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center p-5 text-muted'>No serviceable items to report.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="employee_equipment.php" class="btn btn-light border me-2">Cancel</a>
                            <button type="submit" name="submit_bulk_report" class="btn btn-danger px-4 fw-bold shadow" onclick="return confirm('Submit these reports?');">
                                <i class="bi bi-send-fill me-2"></i> Submit Reports
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        function toggleRemarks(id) {
            // Find the select box and the remarks input for this row
            var selectBox = document.querySelector(`select[name='issue_type[${id}]']`);
            var remarksInput = document.getElementById('remarks_' + id);

            if (selectBox.value !== "") {
                // Show input and make required if issue selected
                remarksInput.style.display = "block";
                remarksInput.required = true;
                remarksInput.focus();
            } else {
                // Hide and clear if "No Issue" selected
                remarksInput.style.display = "none";
                remarksInput.required = false;
                remarksInput.value = "";
            }
        }
    </script>
</body>

</html>