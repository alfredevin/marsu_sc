<?php
include './../config.php';
include '../template/header.php';

// 1. VALIDATE PO ID
if (!isset($_GET['po_id'])) {
    echo "<script>window.location='admin_inspection.php';</script>";
    exit;
}
$po_id = $_GET['po_id'];

// 2. FETCH PO DETAILS
$q_po = mysqli_query($conn, "SELECT po.*, s.supplier_name 
                             FROM purchase_order_tbl po 
                             JOIN supplier_tbl s ON po.supplier_id = s.supplier_id 
                             WHERE po.po_id = '$po_id'");
$po = mysqli_fetch_assoc($q_po);

// 3. HANDLE SAVING (Backend Logic)
if (isset($_POST['save_inspection'])) {
    $ins_officer = mysqli_real_escape_string($conn, $_POST['inspection_officer']);
    $sup_officer = mysqli_real_escape_string($conn, $_POST['supply_officer']);

    // A. Create IAR Header (New Report for this specific delivery)
    $stmt_iar = $conn->prepare("INSERT INTO inspection_report_tbl (po_id, inspection_officer, supply_officer, inspection_date) VALUES (?, ?, ?, NOW())");
    $stmt_iar->bind_param("iss", $po_id, $ins_officer, $sup_officer);
    $stmt_iar->execute();
    $iar_id = $stmt_iar->insert_id;
    $stmt_iar->close();

    $item_ids      = $_POST['item_id'];
    $accepted_qtys = $_POST['accepted_qty'];
    $rejected_qtys = $_POST['rejected_qty'];
    $remarks_list  = $_POST['remarks'];

    // We assume complete, unless we find an item that is still pending
    $po_is_fully_completed = true;

    foreach ($item_ids as $equip_id) {
        $accepted = (int)$accepted_qtys[$equip_id];
        $rejected = (int)$rejected_qtys[$equip_id];
        $remark   = mysqli_real_escape_string($conn, $remarks_list[$equip_id]);

        // Status Logic Text for the Report
        if ($rejected > 0) {
            $status_text = "Has Rejects ($rejected)";
        } else {
            $status_text = "Good Condition";
        }

        // B. Save Line Item (Audit Trail)
        // We always save the inspection result, even if 0 accepted, to record the event.
        if ($accepted > 0 || $rejected > 0) {
            $stmt_item = $conn->prepare("INSERT INTO inspection_items_tbl (iar_id, equipment_id, accepted_qty, rejected_qty, remarks, condition_status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt_item->bind_param("iiiiss", $iar_id, $equip_id, $accepted, $rejected, $remark, $status_text);
            $stmt_item->execute();
        }

        // C. Update Inventory (Smart Logic)
        if ($accepted > 0) {
            // Check if item exists in inventory
            $check_inv = mysqli_query($conn, "SELECT * FROM inventory_tbl WHERE equipment_id = '$equip_id'");

            if (mysqli_num_rows($check_inv) > 0) {
                // UPDATE existing stock
                $update_inv = $conn->prepare("UPDATE inventory_tbl SET qty_on_hand = qty_on_hand + ? WHERE equipment_id = ?");
                $update_inv->bind_param("di", $accepted, $equip_id);
                $update_inv->execute();
            } else {
                // INSERT new stock
                // Get Unit Price from Award
                $price_q = mysqli_query($conn, "SELECT awarded_price FROM awarded_items_tbl WHERE equipment_id='$equip_id' LIMIT 1");
                $price_row = mysqli_fetch_assoc($price_q);
                $unit_cost = $price_row['awarded_price'] ?? 0;

                $stmt_inv = $conn->prepare("INSERT INTO inventory_tbl (equipment_id, qty_on_hand, unit_cost, date_added) VALUES (?, ?, ?, NOW())");
                $stmt_inv->bind_param("idd", $equip_id, $accepted, $unit_cost);
                $stmt_inv->execute();
            }
        }

        // D. Check Balance for PO Status Update
        // 1. Get Total Ordered
        $ordered_res = mysqli_query($conn, "SELECT SUM(quantity) as ordered FROM ppmp_items_tbl WHERE equipment_id = '$equip_id'");
        $ord_row = mysqli_fetch_assoc($ordered_res);
        $total_ordered = $ord_row['ordered'];

        // 2. Get Total Accepted (All time across all IARs for this PO)
        $acc_res = mysqli_query($conn, "
            SELECT SUM(ii.accepted_qty) as total_accepted 
            FROM inspection_items_tbl ii
            JOIN inspection_report_tbl ir ON ii.iar_id = ir.iar_id
            WHERE ir.po_id = '$po_id' AND ii.equipment_id = '$equip_id'
        ");
        $acc_row = mysqli_fetch_assoc($acc_res);
        $total_accepted_all_time = $acc_row['total_accepted'];

        // 3. Compare
        if ($total_accepted_all_time < $total_ordered) {
            $po_is_fully_completed = false; // Still missing items
        }
    }

    // E. Update PO Status
    $new_status = ($po_is_fully_completed) ? 'Completed' : 'Partially Fulfilled';
    mysqli_query($conn, "UPDATE purchase_order_tbl SET status = '$new_status' WHERE po_id = '$po_id'");

    // Success Message
    $alert_msg = ($po_is_fully_completed) ? "All items received. PO marked as Completed." : "Partial delivery saved. PO remains Open for balance.";

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Inspection Saved',
                text: '$alert_msg',
                confirmButtonColor: '#198754'
            }).then(() => {
                window.location.href = 'admin_inspection.php';
            });
        });
    </script>";
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Inspection & Acceptance</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_inspection.php">Pending List</a></li>
                    <li class="breadcrumb-item active">Verify Delivery</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <form method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="card border-start border-primary border-4 shadow-sm">
                            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold text-primary m-0">PO #: <?= $po['po_number'] ?></h5>
                                    <p class="m-0 text-muted small">Supplier: <strong><?= $po['supplier_name'] ?></strong></p>
                                </div>
                                <span class="badge bg-warning text-dark fs-6"><?= $po['status'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="alert alert-info border-0 bg-info bg-opacity-10 small mb-0 py-2 px-3">
                                        <i class="bi bi-info-circle-fill me-2"></i>
                                        <strong>Instruction:</strong> Enter quantity for <b>Accepted (Good)</b>. Any balance will be auto-calculated as Rejected/Missing.
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="autoFill()">
                                        <i class="bi bi-check-all"></i> Receive All Good
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th width="30%" class="text-start">Item Name</th>
                                                <th width="10%">Total Ordered</th>
                                                <th width="10%">Prev. Received</th>
                                                <th width="10%" class="table-warning">Balance</th>
                                                <th width="15%" class="text-success">Accepted (Good)</th>
                                                <th width="15%" class="text-danger">Rejected (Bad)</th>
                                                <th width="10%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sid = $po['supplier_id'];

                                            // QUERY: Get Items linked to this Supplier
                                            $q_items = mysqli_query($conn, "
                                                SELECT e.equipment_id, e.equipment_name, 
                                                (SELECT SUM(quantity) FROM ppmp_items_tbl WHERE equipment_id = aw.equipment_id) as ordered_qty
                                                FROM awarded_items_tbl aw
                                                JOIN equipment_tbl e ON aw.equipment_id = e.equipment_id
                                                WHERE aw.supplier_id = '$sid'
                                            ");

                                            while ($row = mysqli_fetch_assoc($q_items)) {
                                                $eid = $row['equipment_id'];
                                                $ordered = $row['ordered_qty'];

                                                // Calculate Previously Accepted (Sum of all previous IARs for this PO Item)
                                                $q_prev = mysqli_query($conn, "
                                                    SELECT SUM(ii.accepted_qty) as prev_total 
                                                    FROM inspection_items_tbl ii
                                                    JOIN inspection_report_tbl ir ON ii.iar_id = ir.iar_id
                                                    WHERE ir.po_id = '$po_id' AND ii.equipment_id = '$eid'
                                                ");
                                                $prev_row = mysqli_fetch_assoc($q_prev);
                                                $prev_received = $prev_row['prev_total'] ?? 0;

                                                // Calculate Current Balance (This is what we expect to receive now)
                                                $balance = $ordered - $prev_received;

                                                // If Balance is 0, item is fully served.
                                                $is_done = ($balance <= 0);
                                                $bg_class = $is_done ? 'bg-light text-muted' : '';
                                                $readonly = $is_done ? 'readonly' : '';
                                            ?>
                                                <tr id="row_<?= $eid ?>" class="<?= $bg_class ?>">
                                                    <td class="fw-bold">
                                                        <?= $row['equipment_name'] ?>
                                                        <input type="hidden" name="item_id[]" value="<?= $eid ?>">
                                                    </td>
                                                    <td class="text-center"><?= $ordered ?></td>
                                                    <td class="text-center"><?= $prev_received ?></td>

                                                    <td class="text-center fw-bold table-warning">
                                                        <input type="hidden" id="balance_<?= $eid ?>" value="<?= $balance ?>">
                                                        <?= $balance ?>
                                                    </td>

                                                    <td>
                                                        <input type="number" name="accepted_qty[<?= $eid ?>]"
                                                            class="form-control text-center fw-bold text-success accepted-input"
                                                            min="0" max="<?= $balance ?>"
                                                            placeholder="<?= $is_done ? '-' : '0' ?>"
                                                            oninput="calcRejects(<?= $eid ?>)"
                                                            <?= $readonly ?>>
                                                    </td>

                                                    <td>
                                                        <input type="number" name="rejected_qty[<?= $eid ?>]"
                                                            class="form-control text-center fw-bold text-danger rejected-input"
                                                            min="0"
                                                            placeholder="<?= $is_done ? '-' : '0' ?>"
                                                            readonly>

                                                        <input type="hidden" name="remarks[<?= $eid ?>]" class="remarks-input" value="">
                                                    </td>

                                                    <td class="text-center">
                                                        <?php if ($is_done): ?>
                                                            <span class="badge bg-success"><i class="bi bi-check-all"></i> Done</span>
                                                        <?php else: ?>
                                                            <span id="badge_<?= $eid ?>" class="badge bg-secondary">Pending</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="fw-bold">Inspection Officer</label>
                                        <select name="inspection_officer" class="form-select" required>
                                            <option value="">Select...</option>
                                            <?php
                                            $q = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE position_name LIKE '%Inspector%' OR position_name LIKE '%Property%'");
                                            while ($r = mysqli_fetch_assoc($q)) {
                                                echo "<option value='{$r['first_name']} {$r['last_name']}'>{$r['first_name']} {$r['last_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-bold">Supply Officer</label>
                                        <select name="supply_officer" class="form-select" required>
                                            <option value="">Select...</option>
                                            <?php
                                            $q = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE position_name LIKE '%Supply%'");
                                            while ($r = mysqli_fetch_assoc($q)) {
                                                echo "<option value='{$r['first_name']} {$r['last_name']}'>{$r['first_name']} {$r['last_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" name="save_inspection" class="btn btn-primary btn-lg shadow">
                                        <i class="bi bi-save me-2"></i> Submit Inspection
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        // AUTO-CALCULATION SCRIPT
        function calcRejects(id) {
            const balance = parseFloat(document.getElementById('balance_' + id).value) || 0;
            const row = document.getElementById('row_' + id);

            const acceptedInput = row.querySelector('.accepted-input');
            const rejectedInput = row.querySelector('.rejected-input');
            const remarksInput = row.querySelector('.remarks-input');
            const badge = document.getElementById('badge_' + id);

            let accepted = parseFloat(acceptedInput.value);

            if (isNaN(accepted)) {
                rejectedInput.value = "";
                badge.className = "badge bg-secondary";
                badge.innerHTML = "Pending";
                return;
            }

            // Logic: Balance - Accepted = Rejected/Missing
            if (accepted <= balance) {
                let diff = balance - accepted;
                rejectedInput.value = diff;

                if (diff > 0) {
                    badge.className = "badge bg-danger";
                    badge.innerHTML = "Missing: " + diff;
                    remarksInput.value = "Short delivery / Damaged items";
                } else {
                    badge.className = "badge bg-success";
                    badge.innerHTML = "Complete";
                    remarksInput.value = "Good condition";
                }
            } else {
                // Over delivery check
                rejectedInput.value = 0;
                badge.className = "badge bg-info text-dark";
                badge.innerHTML = "Over (+" + (accepted - balance) + ")";
                remarksInput.value = "Over delivery";
            }
        }

        // AUTO-FILL BUTTON
        function autoFill() {
            var inputs = document.querySelectorAll('.accepted-input:not([readonly])');
            inputs.forEach(function(input) {
                var rowId = input.closest('tr').id.replace('row_', '');
                var balance = document.getElementById('balance_' + rowId).value;

                input.value = balance; // Set accepted = balance
                calcRejects(rowId); // Trigger calculation
            });
        }
    </script>
</body>