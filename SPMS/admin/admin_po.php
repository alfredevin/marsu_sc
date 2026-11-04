<?php

include './../config.php';
include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Purchase Orders</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">PO List</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary"><i class="bi bi-receipt-cutoff"></i> Awarded Suppliers & Purchase Orders</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Supplier Name</th>
                                    <th class="text-center">Items Awarded</th>
                                    <th class="text-end">Total Contract Price</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // JOIN with purchase_order_tbl (LEFT JOIN) to check if PO exists
                                $query = "
                                    SELECT 
                                        s.supplier_id, 
                                        s.supplier_name, 
                                        s.address,
                                        po.po_number,
                                        po.status as po_status,
                                        COUNT(aw.id) as item_count,
                                        SUM(aw.awarded_price * (
                                            SELECT SUM(quantity) FROM ppmp_items_tbl WHERE equipment_id = aw.equipment_id
                                        )) as grand_total
                                    FROM awarded_items_tbl aw
                                    JOIN supplier_tbl s ON aw.supplier_id = s.supplier_id
                                    LEFT JOIN purchase_order_tbl po ON s.supplier_id = po.supplier_id
                                    GROUP BY aw.supplier_id
                                    ORDER BY aw.award_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // DETERMINE STATUS
                                        $has_po = !empty($row['po_number']);

                                        if ($has_po) {
                                            $status_badge = '<span class="badge bg-success">PO Submitted to Supplier</span>';
                                            $row_class = ""; // Normal row
                                        } else {
                                            $status_badge = '<span class="badge bg-warning text-dark">Ready for PO Generation</span>';
                                            $row_class = "table-warning"; // Highlight row slightly
                                        }
                                ?>
                                        <tr class="<?= $row_class ?>">
                                            <td>
                                                <div class="fw-bold text-dark"><?= $row['supplier_name'] ?></div>
                                                <div class="small text-muted"><?= $row['address'] ?></div>
                                                <?php if ($has_po): ?>
                                                    <div class="small text-success"><i class="bi bi-upc-scan"></i> <?= $row['po_number'] ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary rounded-pill"><?= $row['item_count'] ?> items</span>
                                            </td>
                                            <td class="text-end fw-bold">
                                                ₱<?= number_format($row['grand_total'], 2) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $status_badge ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="admin_view_po.php?supplier_id=<?= $row['supplier_id'] ?>" class="btn btn-sm btn-outline-primary shadow-sm">
                                                    <i class="bi bi-eye-fill me-1"></i> View Details
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center p-5 text-muted'>No awarded suppliers yet.</td></tr>";
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
</body>

</html>