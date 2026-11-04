<?php
include './../config.php';
include '../template/header.php';
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Returns Management</h1>
            <p>Monitor rejected items and verify if replacements have arrived.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-danger border-4">
                <div class="card-body p-4">
                    <h5 class="card-title text-danger"><i class="bi bi-arrow-counterclockwise"></i> Rejected / Returned Items History</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Date Reported</th>
                                    <th>PO Details</th>
                                    <th>Item & Issue</th>
                                    <th class="text-center">Replacement Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "
                                    SELECT ii.*, ir.inspection_date, po.po_id, po.po_number, s.supplier_name, e.equipment_name, e.equipment_id
                                    FROM inspection_items_tbl ii
                                    JOIN inspection_report_tbl ir ON ii.iar_id = ir.iar_id
                                    JOIN purchase_order_tbl po ON ir.po_id = po.po_id
                                    JOIN supplier_tbl s ON po.supplier_id = s.supplier_id
                                    JOIN equipment_tbl e ON ii.equipment_id = e.equipment_id
                                    WHERE ii.rejected_qty > 0
                                    ORDER BY ir.inspection_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $po_id = $row['po_id'];
                                    $eid = $row['equipment_id'];
                                    $rejected_qty = $row['rejected_qty'];

                                    // --- LOGIC TO CHECK IF REPLACED ---
                                    // Calculate Total Accepted for this PO and Item across ALL inspections
                                    $q_acc = mysqli_query($conn, "
                                        SELECT SUM(ii2.accepted_qty) as total_accepted
                                        FROM inspection_items_tbl ii2
                                        JOIN inspection_report_tbl ir2 ON ii2.iar_id = ir2.iar_id
                                        WHERE ir2.po_id = '$po_id' AND ii2.equipment_id = '$eid'
                                    ");
                                    $acc_row = mysqli_fetch_assoc($q_acc);
                                    $total_accepted = $acc_row['total_accepted'];

                                    // Get Ordered Qty
                                    $q_ord = mysqli_query($conn, "SELECT SUM(quantity) as ordered FROM ppmp_items_tbl WHERE equipment_id = '$eid'");
                                    $ord_row = mysqli_fetch_assoc($q_ord);
                                    $ordered_qty = $ord_row['ordered'];

                                    // Determine Status
                                    if ($total_accepted >= $ordered_qty) {
                                        $status_badge = '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Replaced/Resolved</span>';
                                        $is_resolved = true;
                                    } else {
                                        $status_badge = '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Pending Replacement</span>';
                                        $is_resolved = false;
                                    }
                                ?>
                                    <tr>
                                        <td><?= date("M d, Y", strtotime($row['inspection_date'])) ?></td>
                                        <td>
                                            <span class="fw-bold text-primary"><?= $row['po_number'] ?></span><br>
                                            <small class="text-muted"><?= $row['supplier_name'] ?></small>
                                        </td>
                                        <td>
                                            <span class="fw-bold"><?= $row['equipment_name'] ?></span><br>
                                            <span class="badge bg-danger">Returned: <?= $rejected_qty ?></span>
                                            <div class="text-danger fst-italic small mt-1">"<?= $row['remarks'] ?>"</div>
                                        </td>
                                        
                                        <td class="text-center">
                                            <?= $status_badge ?>
                                            <?php if($is_resolved): ?>
                                                <div class="small text-muted mt-1">Item fully delivered.</div>
                                            <?php else: ?>
                                                <div class="small text-danger mt-1">Waiting for supplier...</div>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <a href="print_return_slip.php?iar_id=<?= $row['iar_id'] ?>" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                                <i class="bi bi-printer"></i> Print Slip
                                            </a>
                                            <?php if(!$is_resolved): ?>
                                                <a href="admin_inspection_form.php?po_id=<?= $po_id ?>" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-box-seam"></i> Receive
                                                </a>
                                            <?php endif; ?>
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
</body>
</html>