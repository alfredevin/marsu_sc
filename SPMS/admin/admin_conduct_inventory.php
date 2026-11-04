<?php
include './../config.php';
include '../template/header.php';

// --- HANDLE SAVE (Update Status & Save History) ---
if (isset($_POST['save_inventory'])) {
    $dept_id_save = $_POST['dept_id_save'];
    $conducted_by = $_POST['conducted_by'];
    $date_conducted = $_POST['date_conducted'];

    // 1. Save Inventory Header (Log who did it and when)
    $stmt = mysqli_prepare($conn, "INSERT INTO inventory_conduct_tbl (department_id, conducted_by, date_conducted) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iss", $dept_id_save, $conducted_by, $date_conducted);
    mysqli_stmt_execute($stmt);
    $conduct_id = mysqli_insert_id($conn);

    // 2. Process Items
    if (isset($_POST['item_id'])) {
        $ids = $_POST['item_id'];
        $statuses = $_POST['status']; // Array of radio values
        $remarks = $_POST['remarks'];

        foreach ($ids as $id) {
            // If status is not set (radio unchecked), default to Serviceable
            $stat = isset($statuses[$id]) ? $statuses[$id] : 'Serviceable';
            $rem = $remarks[$id];

            // A. Update Current Status in Main Table (Real-time status)
            $update_sql = "UPDATE issuance_items_tbl SET status = '$stat', remarks = '$rem' WHERE id = '$id'";
            mysqli_query($conn, $update_sql);

            // B. Save Snapshot to History (Audit Trail)
            $hist_sql = "INSERT INTO inventory_conduct_items_tbl (conduct_id, issuance_item_id, recorded_status, recorded_remarks) VALUES ('$conduct_id', '$id', '$stat', '$rem')";
            mysqli_query($conn, $hist_sql);
        }
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ 
                icon: 'success', 
                title: 'Inventory Saved!', 
                text: 'Equipment status updated and logged to history.', 
                timer: 2000, 
                showConfirmButton: false 
            }).then(() => { 
                window.location.href = 'admin_conduct_inventory.php?dept_id=$dept_id_save'; 
            });
        });
    </script>";
}

$dept_id = isset($_GET['dept_id']) ? $_GET['dept_id'] : '';
?>

<style>
    /* Floating Save Bar */
    .sticky-save-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        padding: 15px 30px;
        box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
        z-index: 1050;
        display: none;
        /* Hidden by default */
        border-top: 1px solid #dee2e6;
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }

        to {
            transform: translateY(0);
        }
    }

    /* Add padding to body so content isn't hidden behind bar */
    body.has-changes {
        padding-bottom: 80px;
    }

    /* Table Tweaks */
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Physical Count (Inventory)</h1>
            <p class="text-muted">Conduct physical inventory per department and update equipment status.</p>
        </div>

        <section class="section">

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-4 bg-white rounded">
                    <form method="GET" class="row align-items-end">
                        <div class="col-md-8">
                            <label class="fw-bold small text-secondary mb-1">SELECT DEPARTMENT TO INVENTORY</label>
                            <div class="input-group">
                                <select name="dept_id" class="form-select form-select-lg border-primary" onchange="this.form.submit()">
                                    <option value="">-- Choose Department --</option>
                                    <?php
                                    $d_res = mysqli_query($conn, "SELECT * FROM department_tbl ORDER BY department_name");
                                    while ($d = mysqli_fetch_assoc($d_res)) {
                                        $sel = ($d['department_id'] == $dept_id) ? 'selected' : '';
                                        echo "<option value='{$d['department_id']}' $sel>{$d['department_name']}</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Load Items</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if ($dept_id): ?>
                <form method="POST" id="inventoryForm">
                    <input type="hidden" name="dept_id_save" value="<?= $dept_id ?>">

                    <div class="card shadow-sm border-top border-primary border-4">
                        <div class="card-body p-4">

                            <div class="row mb-4 p-3 bg-light rounded border mx-0">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Inventory Conducted By</label>
                                    <input type="text" name="conducted_by" class="form-control" id="inspector" required placeholder="Name of Officer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Date of Inventory</label>
                                    <input type="date" name="date_conducted" class="form-control" id="date" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 sticky-top bg-white py-2" style="top: 60px; z-index: 999;">
                                <h5 class="text-primary fw-bold m-0"><i class="bi bi-list-check"></i> Item Checklist</h5>
                                <button type="submit" name="save_inventory" class="btn btn-success px-4 shadow-sm fw-bold" onclick="return confirm('Save inventory updates?');">
                                    <i class="bi bi-save me-2"></i> SAVE UPDATES
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle border">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="15%">Property No.</th>
                                            <th width="25%">Description</th>
                                            <th width="20%">Accountable Person</th>
                                            <th width="20%" class="text-center">Status Check</th>
                                            <th width="20%">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Get Items issued to employees OF THE SELECTED DEPARTMENT
                                        $q_items = "
                                        SELECT ii.id, ii.property_number, ii.status, ii.remarks,
                                               e.equipment_name, emp.first_name, emp.last_name
                                        FROM issuance_items_tbl ii
                                        JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                        JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                        JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                        JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                        WHERE emp.department_id = '$dept_id'
                                        ORDER BY emp.last_name ASC, ii.property_number ASC
                                    ";
                                        $res_items = mysqli_query($conn, $q_items);

                                        if (mysqli_num_rows($res_items) > 0) {
                                            while ($row = mysqli_fetch_assoc($res_items)) {
                                                $id = $row['id'];
                                                $status = $row['status'] ?? 'Serviceable';
                                                $is_missing = ($status == 'Missing');
                                        ?>
                                                <tr id="row_<?= $id ?>">
                                                    <td class="fw-bold text-dark">
                                                        <i class="bi bi-qr-code text-muted me-1"></i> <?= $row['property_number'] ?>
                                                        <input type="hidden" name="item_id[]" value="<?= $id ?>">
                                                    </td>

                                                    <td><?= $row['equipment_name'] ?></td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded-circle me-2 text-center small pt-1" style="width:30px;height:30px;">
                                                                <?= substr($row['first_name'], 0, 1) ?>
                                                            </div>
                                                            <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="btn-group w-100" role="group">
                                                            <input type="radio" class="btn-check" name="status[<?= $id ?>]" id="good_<?= $id ?>" value="Serviceable"
                                                                <?= !$is_missing ? 'checked' : '' ?> onchange="toggleRemarks(<?= $id ?>, false)">
                                                            <label class="btn btn-outline-success btn-sm" for="good_<?= $id ?>">
                                                                <i class="bi bi-check-circle"></i> OK
                                                            </label>

                                                            <input type="radio" class="btn-check" name="status[<?= $id ?>]" id="miss_<?= $id ?>" value="Missing"
                                                                <?= $is_missing ? 'checked' : '' ?> onchange="toggleRemarks(<?= $id ?>, true)">
                                                            <label class="btn btn-outline-danger btn-sm" for="miss_<?= $id ?>">
                                                                <i class="bi bi-exclamation-circle"></i> Missing
                                                            </label>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <input type="text" name="remarks[<?= $id ?>]" id="remark_<?= $id ?>"
                                                            class="form-control form-control-sm bg-light border-0"
                                                            value="<?= $row['remarks'] ?>" placeholder="State reason..."
                                                            style="display: <?= $is_missing ? 'block' : 'none' ?>;">
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center p-5 text-muted'>No issued items found for this department.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="sticky-save-bar d-flex justify-content-between align-items-center" id="saveBar">
                        <div class="text-dark fw-bold">
                            <i class="bi bi-info-circle-fill text-warning me-2"></i> You have unsaved changes.
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-secondary me-2" onclick="location.reload()">Discard</button>
                            <button type="submit" name="save_inventory" class="btn btn-primary px-4 shadow fw-bold">
                                <i class="bi bi-save me-1"></i> Save Updates
                            </button>
                        </div>
                    </div>

                </form>
            <?php endif; ?>

        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        function toggleRemarks(id, isMissing) {
            var input = document.getElementById('remark_' + id);

            if (isMissing) {
                // Show textbox if Missing
                input.style.display = 'block';
                input.focus();
            } else {
                // Hide and clear if OK
                input.style.display = 'none';
                input.value = '';
            }

            // Show Sticky Save Bar
            document.getElementById('saveBar').style.display = 'flex';
            document.body.classList.add('has-changes');
        }

        // Also show bar if Inspector Name changes
        document.getElementById('inspector').addEventListener('input', function() {
            document.getElementById('saveBar').style.display = 'flex';
        });
    </script>
</body>

</html>